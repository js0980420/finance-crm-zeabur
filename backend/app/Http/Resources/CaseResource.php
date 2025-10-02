<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    /**
     * 將資料庫格式轉換為前端標準 API 格式
     *
     * 前端統一使用的欄位名稱：
     * - phone (不是 customer_phone)
     * - email (不是 customer_email)
     * - loan_purpose (不是 consultation_item)
     * - website (不是 website_source)
     * - case_status: 'pending' (不是 'unassigned')
     */
    public function toArray($request)
    {
        return [
            // 基本資訊
            'id' => $this->id,
            'case_number' => $this->case_number,

            // 客戶資訊（映射到前端友善的欄位名稱）
            'customer_name' => $this->customer_name,
            'phone' => $this->customer_phone,              // DB: customer_phone → API: phone
            'email' => $this->customer_email,              // DB: customer_email → API: email

            // LINE 資訊
            'line_id' => $this->line_add_friend_id,        // DB: line_add_friend_id → API: line_id
            'line_display_name' => $this->line_display_name,
            'line_user_info' => $this->line_display_name ? [
                'display_name' => $this->line_display_name,
            ] : null,

            // 業務資訊
            'loan_purpose' => $this->consultation_item,    // DB: consultation_item → API: loan_purpose
            'demand_amount' => $this->demand_amount,

            // 來源資訊
            'channel' => $this->channel,
            'website' => $this->website_source,            // DB: website_source → API: website

            // 狀態資訊（映射到前端友善的狀態名稱）
            'case_status' => $this->mapStatusToFrontend($this->status),
            'status' => $this->mapStatusToFrontend($this->status),  // 相容性

            // 指派資訊
            'assigned_to' => $this->assigned_to,
            'assigned_at' => $this->assigned_at,
            'assignee' => $this->when($this->assignedUser, function() {
                return [
                    'id' => $this->assignedUser->id,
                    'name' => $this->assignedUser->name,
                ];
            }),

            // 審核資訊
            'approved_amount' => $this->approved_amount,
            'disbursed_amount' => $this->disbursed_amount,
            'rejection_reason' => $this->rejection_reason,

            // 備註
            'notes' => $this->notes,

            // 狀態更新資訊
            'status_updated_at' => $this->status_updated_at,
            'status_updated_by' => $this->status_updated_by,
            'statusUpdater' => $this->when($this->statusUpdater, function() {
                return [
                    'id' => $this->statusUpdater->id,
                    'name' => $this->statusUpdater->name,
                ];
            }),

            // 時間戳記
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
        ];
    }

    /**
     * 將資料庫狀態映射為前端狀態
     */
    private function mapStatusToFrontend($dbStatus)
    {
        $mapping = [
            'unassigned' => 'pending',
            'valid_customer' => 'valid_customer',
            'invalid_customer' => 'invalid_customer',
            'customer_service' => 'customer_service',
            'blacklist' => 'blacklist',
            'approved_disbursed' => 'approved_disbursed',
            'approved_undisbursed' => 'approved_undisbursed',
            'conditional_approval' => 'conditional_approval',
            'rejected' => 'rejected',
            'declined' => 'declined',
            'tracking' => 'tracking',
        ];

        return $mapping[$dbStatus] ?? $dbStatus;
    }
}
