<?php

namespace App\Services;

class CaseMapper
{
    /**
     * 將前端標準 API 格式映射為資料庫格式
     *
     * 前端送來的欄位名稱 → 資料庫欄位名稱
     */
    public static function mapApiToDatabase(array $apiData): array
    {
        $dbData = [];

        // 基本資訊
        if (isset($apiData['customer_name'])) {
            $dbData['customer_name'] = $apiData['customer_name'];
        }

        // 聯絡資訊（前端 → 資料庫）
        if (isset($apiData['phone'])) {
            $dbData['customer_phone'] = $apiData['phone'];  // phone → customer_phone
        }
        if (isset($apiData['mobile_phone'])) {
            $dbData['customer_phone'] = $apiData['mobile_phone'];  // mobile_phone → customer_phone
        }
        if (isset($apiData['email'])) {
            $dbData['customer_email'] = $apiData['email'];  // email → customer_email
        }

        // LINE 資訊
        if (isset($apiData['line_id'])) {
            $dbData['line_add_friend_id'] = $apiData['line_id'];  // line_id → line_add_friend_id
        }
        if (isset($apiData['line_display_name'])) {
            $dbData['line_display_name'] = $apiData['line_display_name'];
        }
        // 支援巢狀格式
        if (isset($apiData['line_user_info']['display_name'])) {
            $dbData['line_display_name'] = $apiData['line_user_info']['display_name'];
        }

        // 業務資訊
        if (isset($apiData['loan_purpose'])) {
            $dbData['consultation_item'] = $apiData['loan_purpose'];  // loan_purpose → consultation_item
        }
        if (isset($apiData['demand_amount'])) {
            $dbData['demand_amount'] = $apiData['demand_amount'];
        }

        // 來源資訊
        if (isset($apiData['channel'])) {
            $dbData['channel'] = $apiData['channel'];
        }
        if (isset($apiData['website'])) {
            $dbData['website_source'] = $apiData['website'];  // website → website_source
        }

        // 狀態（前端友善名稱 → 資料庫名稱）
        if (isset($apiData['case_status'])) {
            $dbData['status'] = self::mapFrontendStatusToDatabase($apiData['case_status']);
        } elseif (isset($apiData['status'])) {
            $dbData['status'] = self::mapFrontendStatusToDatabase($apiData['status']);
        }

        // 指派資訊
        if (isset($apiData['assigned_to'])) {
            $dbData['assigned_to'] = $apiData['assigned_to'];
        }

        // 審核資訊
        if (isset($apiData['approved_amount'])) {
            $dbData['approved_amount'] = $apiData['approved_amount'];
        }
        if (isset($apiData['disbursed_amount'])) {
            $dbData['disbursed_amount'] = $apiData['disbursed_amount'];
        }
        if (isset($apiData['rejection_reason'])) {
            $dbData['rejection_reason'] = $apiData['rejection_reason'];
        }

        // 貸款資訊（額外支援）
        if (isset($apiData['loan_amount'])) {
            $dbData['loan_amount'] = $apiData['loan_amount'];
        }
        if (isset($apiData['loan_type'])) {
            $dbData['loan_type'] = $apiData['loan_type'];
        }
        if (isset($apiData['loan_term'])) {
            $dbData['loan_term'] = $apiData['loan_term'];
        }
        if (isset($apiData['interest_rate'])) {
            $dbData['interest_rate'] = $apiData['interest_rate'];
        }

        // 備註
        if (isset($apiData['notes'])) {
            $dbData['notes'] = $apiData['notes'];
        }

        return $dbData;
    }

    /**
     * 將前端狀態映射為資料庫狀態
     */
    public static function mapFrontendStatusToDatabase(string $frontendStatus): string
    {
        $mapping = [
            'pending' => 'unassigned',
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

        return $mapping[$frontendStatus] ?? $frontendStatus;
    }

    /**
     * 將資料庫狀態映射為前端狀態
     */
    public static function mapDatabaseStatusToFrontend(string $dbStatus): string
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
