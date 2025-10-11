<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'case_status',
        'assigned_to',
        'channel', // wp_form, phone_call, line, email
        'source', // page url / website
        'website',
        'name',
        'phone',
        'email',
        'li_id',
        'line_display_name', // LINE 顯示名稱
        'loan_purpose', // 諮詢項目
        'business_level', // 業務等級 A/B/C
        'ip_address',
        'user_agent',
        'payload',
        'is_suspected_blacklist',
        'suspected_reason',
        'notes', // 備註
        'created_by', // 建立者
        'assigned_at', // 指派時間

        // 個人資料
        'birth_date',
        'id_number',
        'education',
        'case_number',

        // 聯絡資訊
        'city',
        'district',
        'street',
        'landline_phone',
        'comm_address_same_as_home',
        'comm_address',
        'contact_time',
        'residence_duration',
        'residence_owner',
        'telecom_operator',

        // 公司資料
        'company_name',
        'company_phone',
        'company_address',
        'job_title',
        'monthly_income',
        'has_labor_insurance',
        'company_tenure',

        // 貸款資訊
        'demand_amount',
        'loan_amount',
        'loan_type',
        'loan_term',
        'interest_rate',

        // 緊急聯絡人
        'emergency_contact_1_name',
        'emergency_contact_1_relationship',
        'emergency_contact_1_phone',
        'contact_time_1',
        'confidential_1',
        'emergency_contact_2_name',
        'emergency_contact_2_relationship',
        'emergency_contact_2_phone',
        'contact_time_2',
        'confidential_2',

        // 其他
        'referrer',
    ];

    protected $casts = [
        'payload' => 'array',
        'is_suspected_blacklist' => 'boolean',
        'has_labor_insurance' => 'boolean',
        'confidential_1' => 'boolean',
        'confidential_2' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Point 40: Get the website this lead came from
     */
    public function website()
    {
        return $this->belongsTo(Website::class, 'source', 'domain');
    }

    /**
     * 案件圖片
     */
    public function images()
    {
        return $this->hasMany(CaseImage::class, 'case_id');
    }
}
