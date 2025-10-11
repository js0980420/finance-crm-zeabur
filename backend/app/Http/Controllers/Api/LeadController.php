<?php

namespace App\Http\Controllers\Api;

use App\Enums\LeadStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\CustomerLead;
use App\Models\CaseImage;
use App\Models\LineUser;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // GET /api/leads
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = CustomerLead::with(['customer','assignee','images']);

        // 預設顯示 WP 表單進件
        if ($request->has('channel')) {
            $query->where('channel', $request->get('channel', 'wp_form'));
        }

        // 搜尋：name/phone/email/line_id/source
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('line_id', 'like', "%$search%")
                    ->orWhere('source', 'like', "%$search%")
                    ->orWhere('ip_address', 'like', "%$search%");
            });
        }

        // 篩選：案件狀態 case_status
        if ($request->filled('case_status')) {
            $query->where('case_status', $request->get('case_status'));
        }

        // 兼容舊的 status 參數
        if ($request->filled('status')) {
            $query->where('case_status', $request->get('status'));
        }

        // 角色權限：非 admin/executive/manager 則自動限制為只看自己（staff）
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        $query->when(!$isPrivileged, function ($q) use ($user) {
            $q->where('assigned_to', $user->id);
        }, function ($q) use ($request) {
            // 未指派也要能看見（例如回退後)
            if ($request->get('assigned_to') === 'all') {
                //
            } elseif ($request->get('assigned_to') === 'null') {
                $q->whereNull('assigned_to');
            } elseif ($request->get('assigned_to')) {
                $q->where('assigned_to', $request->get('assigned_to'));
            }
        });

        if ($request->has('is_suspected_blacklist')) {
            $query->where('is_suspected_blacklist', (bool)$request->get('is_suspected_blacklist'));
        }

        if ($request->has('website_source')) {
            $query->where('source', 'like', "%".$request->get('website_source')."%");
        }
        // return response()->json(
        //     $query->toRawSql()
        // );
        $perPage = (int)($request->get('per_page', 15));
        $leads = $query->orderByDesc('created_at')->paginate($perPage);
        
        // Point 37: 加載LINE用戶資訊
        $leads->getCollection()->transform(function ($lead) {
            // 檢查line_id是否存在，並判斷是否為user_id格式
            if ($lead->line_id) {
                $lineId = $lead->line_id;
                
                // Point 37: 區分user_id與line_id格式
                $lead->is_line_user_id = $this->isLineUserId($lineId);
                
                if ($lead->is_line_user_id) {
                    // 如果是user_id格式，查詢line_users表獲取完整資料
                    $lineUser = LineUser::where('line_user_id', $lineId)->first();
                    if ($lineUser) {
                        $lead->line_user_info = [
                            'id' => $lineUser->id,
                            'display_name' => $lineUser->getDisplayName(), // Point 39: 優先顯示業務名稱
                            'api_display_name' => $lineUser->getApiDisplayName(), // Point 39: API原始名稱（僅供參考）
                            'display_name_original' => $lineUser->display_name_original,
                            'business_display_name' => $lineUser->business_display_name,
                            'has_custom_name' => $lineUser->hasCustomBusinessName(),
                            'picture_url' => $lineUser->picture_url,
                            'status_message' => $lineUser->status_message,
                            'profile_completeness' => $lineUser->getProfileCompletenessScore(),
                            'is_friend' => $lineUser->is_friend,
                            'editable_name' => $lineUser->getDisplayName(), // Point 39: 業務可編輯的名稱
                            'business_name_updated_by' => $lineUser->business_name_updated_by,
                            'business_name_updated_at' => $lineUser->business_name_updated_at
                        ];
                    } else {
                        $lead->line_user_info = null;
                    }
                } else {
                    // 如果是一般line_id，保持原有顯示
                    $lead->line_user_info = null;
                }
            } else {
                $lead->is_line_user_id = false;
                $lead->line_user_info = null;
            }
            
            return $lead;
        });
        
        return response()->json($leads);
    }

    // POST /api/leads
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'nullable|exists:customers,id',
            'name' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'channel' => 'required|in:wp,lineoa,email,phone,wp_form',
            'line_id' => 'nullable|string|max:100',
            'ip_address' => 'nullable|string|max:45',
            'source' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string|max:1000',
            'payload' => 'nullable|array',
            'case_status' => ['nullable', Rule::in(LeadStatus::values())],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // 處理 payload
        $payload = $data['payload'] ?? [];
        if (isset($data['notes'])) {
            $payload['notes'] = $data['notes'];
            unset($data['notes']);
        }

        // 移除 payload 從主要資料中
        unset($data['payload']);

        // 創建 lead
        $lead = new CustomerLead($data);
        $lead->payload = $payload;
        $lead->case_status = $data['case_status'] ?? LeadStatus::Pending->value;
        $lead->save();

        return response()->json([
            'message' => 'Lead created successfully',
            'lead' => $lead->load('customer', 'assignee')
        ], 201);
    }

    // GET /api/leads/{lead}
    public function show(CustomerLead $lead)
    {
        return response()->json(['lead' => $lead->load('customer', 'images')]);
    }

    // GET /api/leads/submittable
    public function submittable(Request $request)
    {
        $user = Auth::user();
        $query = CustomerLead::with(['customer','assignee'])
            ->whereIn('case_status', ['valid_customer', 'tracking']);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('line_id', 'like', "%$search%")
                    ->orWhere('source', 'like', "%$search%")
                    ->orWhere('ip_address', 'like', "%$search%");
            });
        }

        // 角色權限：非 admin/executive/manager 則只看自己（staff）
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        if (!$isPrivileged) {
            $query->where('assigned_to', $user->id);
        }
        // return response()->json(
        //     $query->toRawSql()
        // );
        $perPage = (int)($request->get('per_page', 15));
        $leads = $query->orderByDesc('created_at')->paginate($perPage);
        return response()->json($leads);
    }

    // PUT /api/leads/{lead}
    public function update(Request $request, CustomerLead $lead)
    {
        $user = Auth::user();
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        if (!$isPrivileged && $lead->assigned_to !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'sometimes|exists:customers,id',
            'case_status' => ['sometimes', Rule::in(LeadStatus::values())],
            'assigned_to' => 'sometimes|nullable|exists:users,id',
            'channel' => 'sometimes|in:wp,lineoa,email,phone,wp_form',
            'source' => 'sometimes|nullable|string',
            'website' => 'sometimes|nullable|string',
            'name' => 'sometimes|nullable|string|max:100',
            'phone' => 'sometimes|nullable|string|max:20',
            'email' => 'sometimes|nullable|email',
            'line_id' => 'sometimes|nullable|string|max:100',
            'line_display_name' => 'sometimes|nullable|string',
            'loan_purpose' => 'sometimes|nullable|string',
            'business_level' => 'sometimes|nullable|string',
            'ip_address' => 'sometimes|nullable|string',
            'user_agent' => 'sometimes|nullable|string',
            'is_suspected_blacklist' => 'sometimes|boolean',
            'suspected_reason' => 'sometimes|nullable|string',
            'notes' => 'sometimes|nullable|string',
            'created_by' => 'sometimes|nullable|exists:users,id',
            'assigned_at' => 'sometimes|nullable|date',

            // 個人資料
            'birth_date' => 'sometimes|nullable|date',
            'id_number' => 'sometimes|nullable|string|max:20',
            'education' => 'sometimes|nullable|string',
            'case_number' => 'sometimes|nullable|string',

            // 聯絡資訊
            'city' => 'sometimes|nullable|string',
            'district' => 'sometimes|nullable|string',
            'street' => 'sometimes|nullable|string',
            'landline_phone' => 'sometimes|nullable|string',
            'comm_address_same_as_home' => 'sometimes|nullable|boolean',
            'comm_address' => 'sometimes|nullable|string',
            'residence_duration' => 'sometimes|nullable|string',
            'residence_owner' => 'sometimes|nullable|string',
            'telecom_operator' => 'sometimes|nullable|string',

            // 公司資料
            'company_name' => 'sometimes|nullable|string',
            'company_phone' => 'sometimes|nullable|string',
            'company_address' => 'sometimes|nullable|string',
            'job_title' => 'sometimes|nullable|string',
            'monthly_income' => 'sometimes|nullable|numeric',
            'has_labor_insurance' => 'sometimes|nullable|boolean',
            'company_tenure' => 'sometimes|nullable|string',

            // 貸款資訊
            'demand_amount' => 'sometimes|nullable|numeric',
            'loan_amount' => 'sometimes|nullable|numeric',
            'loan_type' => 'sometimes|nullable|string',
            'loan_term' => 'sometimes|nullable|string',
            'interest_rate' => 'sometimes|nullable|numeric',

            // 緊急聯絡人
            'emergency_contact_1_name' => 'sometimes|nullable|string',
            'emergency_contact_1_relationship' => 'sometimes|nullable|string',
            'emergency_contact_1_phone' => 'sometimes|nullable|string',
            'contact_time_1' => 'sometimes|nullable|string',
            'confidential_1' => 'sometimes|nullable|boolean',
            'emergency_contact_2_name' => 'sometimes|nullable|string',
            'emergency_contact_2_relationship' => 'sometimes|nullable|string',
            'emergency_contact_2_phone' => 'sometimes|nullable|string',
            'contact_time_2' => 'sometimes|nullable|string',
            'confidential_2' => 'sometimes|nullable|boolean',

            // 其他
            'referrer' => 'sometimes|nullable|string',
            'payload' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 取得所有驗證後的資料（除了 payload）
        $data = collect($validator->validated())
            ->except(['payload'])
            ->toArray();

        // Debug: 記錄接收到的資料和驗證後的資料
        \Log::info('LeadController@update - Request data:', [
            'request_all' => $request->all(),
            'validated' => $data,
            'diff_count' => count($request->all()) - count($data),
        ]);

        // 記錄更新前的資料
        $originalData = $lead->only(array_keys($data));
        \Log::info('LeadController@update - Before update:', [
            'id' => $lead->id,
            'original' => $originalData,
        ]);

        $lead->fill($data);

        // 記錄 dirty 的欄位
        \Log::info('LeadController@update - Dirty fields:', [
            'dirty' => $lead->getDirty(),
            'isDirty' => $lead->isDirty(),
        ]);

        // 合併 payload（保留原有）
        if ($request->has('payload') && is_array($request->payload)) {
            $payload = is_array($lead->payload) ? $lead->payload : [];
            $payload = array_merge($payload, $request->payload);
            $lead->payload = $payload;
        }

        $lead->save();

        // 處理圖片上傳
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            if (!is_array($images)) {
                $images = [$images];
            }

            foreach ($images as $image) {
                if ($image->isValid()) {
                    // 生成唯一檔名
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    // 儲存到 storage/app/public/case_images
                    $filePath = $image->storeAs('case_images', $fileName, 'public');

                    // 保存到資料庫
                    CaseImage::create([
                        'case_id' => $lead->id,
                        'file_path' => $filePath,
                        'file_name' => $image->getClientOriginalName(),
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'updated',
            'lead' => $lead->load('customer', 'assignee', 'images')
        ]);
    }

    // PATCH /api/leads/{lead}/case-status
    public function updateCaseStatus(Request $request, CustomerLead $lead)
    {
        $user = Auth::user();
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        if (!$isPrivileged && $lead->assigned_to !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'case_status' => ['required', Rule::in(LeadStatus::values())],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $lead->case_status = $request->case_status;
        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Case status updated successfully',
            'lead' => $lead->load('customer', 'assignee')
        ]);
    }

    // DELETE /api/leads/{lead}
    public function destroy(CustomerLead $lead)
    {
        $user = Auth::user();
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        if (!$isPrivileged && $lead->assigned_to !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        // 簡單刪除 lead，不刪除 customer
        $lead->delete();
        return response()->json(['message' => 'deleted']);
    }

    // GET /api/leads/export/csv - 導出案件資料為 CSV
    public function exportCsv(Request $request)
    {
        $user = Auth::user();
        $query = CustomerLead::with(['customer', 'assignee', 'images']);

        // 套用相同的篩選邏輯
        if ($request->has('channel')) {
            $query->where('channel', $request->get('channel', 'wp_form'));
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($request->filled('case_status')) {
            $query->where('case_status', $request->get('case_status'));
        }

        // 角色權限
        $isPrivileged = $user && $user->hasAnyRole(['admin', 'executive', 'manager']);
        if (!$isPrivileged) {
            $query->where('assigned_to', $user->id);
        }

        $leads = $query->orderByDesc('created_at')->get();

        // 生成 CSV
        $csvData = [];
        $csvData[] = [
            'ID', '案件編號', '案件狀態', '姓名', '手機', 'Email', '身分證字號', '出生日期', '最高學歷',
            '戶籍地址', '市話', '通訊地址同戶籍', '通訊地址', '居住時間', '居住身分', '電信業者',
            '公司名稱', '公司電話', '公司地址', '職稱', '月收入', '有無薪轉勞保', '到職時間',
            '需求金額', '貸款金額', '貸款類型', '貸款期數', '利率',
            '緊急聯絡人1', '關係1', '電話1', '聯絡時間1', '保密1',
            '緊急聯絡人2', '關係2', '電話2', '聯絡時間2', '保密2',
            '介紹人', '業務等級', '備註', '建立時間', '圖片連結'
        ];

        foreach ($leads as $lead) {
            $imageUrls = $lead->images->map(function($img) {
                return $img->url;
            })->implode(', ');

            $csvData[] = [
                $lead->id,
                $lead->case_number,
                $lead->case_status,
                $lead->name,
                $lead->phone,
                $lead->email,
                $lead->id_number,
                $lead->birth_date,
                $lead->education,
                $lead->city . $lead->district . $lead->street,
                $lead->landline_phone,
                $lead->comm_address_same_as_home ? '是' : '否',
                $lead->comm_address,
                $lead->residence_duration,
                $lead->residence_owner,
                $lead->telecom_operator,
                $lead->company_name,
                $lead->company_phone,
                $lead->company_address,
                $lead->job_title,
                $lead->monthly_income,
                $lead->has_labor_insurance ? '是' : '否',
                $lead->company_tenure,
                $lead->demand_amount,
                $lead->loan_amount,
                $lead->loan_type,
                $lead->loan_term,
                $lead->interest_rate,
                $lead->emergency_contact_1_name,
                $lead->emergency_contact_1_relationship,
                $lead->emergency_contact_1_phone,
                $lead->contact_time_1,
                $lead->confidential_1 ? '是' : '否',
                $lead->emergency_contact_2_name,
                $lead->emergency_contact_2_relationship,
                $lead->emergency_contact_2_phone,
                $lead->contact_time_2,
                $lead->confidential_2 ? '是' : '否',
                $lead->referrer,
                $lead->business_level,
                $lead->notes,
                $lead->created_at,
                $imageUrls
            ];
        }

        // 生成 CSV 檔案
        $filename = 'leads_export_' . date('YmdHis') . '.csv';
        $handle = fopen('php://temp', 'r+');

        // 添加 BOM 以支援中文
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Point 37: 判斷是否為LINE user_id格式
     * LINE user_id 格式：U + 32位字母數字，總長度33
     */
    private function isLineUserId($lineId)
    {
        // LINE user_id格式檢查：以U開頭，總長度33字符，只包含字母數字
        return preg_match('/^U[a-f0-9]{32}$/i', $lineId) === 1;
    }
    
    /**
     * Point 39: 更新LINE用戶的業務顯示名稱（不影響API原始資料）
     */
    public function updateLineUserName(Request $request, $leadId)
    {
        $lead = CustomerLead::findOrFail($leadId);
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'editable_name' => 'required|string|max:100'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $editableName = $request->get('editable_name');
        
        // 如果是LINE user_id格式，更新LineUser表中的業務顯示名稱
        if ($lead->line_id && $this->isLineUserId($lead->line_id)) {
            $lineUser = LineUser::where('line_user_id', $lead->line_id)->first();
            if ($lineUser) {
                $oldName = $lineUser->getDisplayName();
                $oldApiName = $lineUser->getApiDisplayName();
                
                // Point 39: 使用業務名稱更新方法，保護API原始資料
                $lineUser->updateBusinessDisplayName($editableName, $user ? $user->id : null);
                
                // 記錄名稱變更
                \Log::info('Point 39 - LINE用戶業務名稱變更', [
                    'lead_id' => $leadId,
                    'line_user_id' => $lead->line_id,
                    'line_user_table_id' => $lineUser->id,
                    'old_business_name' => $oldName,
                    'new_business_name' => $editableName,
                    'api_name_preserved' => $oldApiName,
                    'updated_by' => $user ? $user->id : null,
                    'updated_by_name' => $user ? $user->name : 'Unknown',
                    'updated_at' => now(),
                    'note' => 'API原始名稱已保護，不受業務修改影響'
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'LINE用戶名稱更新成功',
                    'old_name' => $oldName,
                    'new_name' => $editableName
                ]);
            }
        }
        
        return response()->json([
            'success' => false,
            'message' => '無法更新：此不是有效的LINE用戶'
        ], 400);
    }
}
