<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tracking_records', function (Blueprint $table) {
            // 添加追蹤紀錄所需的欄位
            $table->string('customer_name')->nullable()->after('customer_id'); // 客戶姓名
            $table->foreignId('tracking_person_id')->nullable()->after('user_id')->constrained('users')->onDelete('set null'); // 記錄人員
            $table->dateTime('contact_time')->nullable()->after('tracking_person_id'); // 聯繫時間
            $table->string('service_stage')->nullable()->after('contact_time'); // 服務階段
            $table->string('opportunity_order')->nullable()->after('service_stage'); // 商機單
            $table->text('maintenance_progress')->nullable()->after('opportunity_order'); // 維護進度
            $table->string('opportunity_status')->nullable()->after('maintenance_progress'); // 商機狀態
            $table->string('contact_method')->nullable()->after('opportunity_status'); // 聯絡方式
            $table->text('conversation_record')->nullable()->after('contact_method'); // 對話紀錄

            // 將原有的 activity_type 和 description 改為可空
            $table->string('activity_type')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tracking_records', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'tracking_person_id',
                'contact_time',
                'service_stage',
                'opportunity_order',
                'maintenance_progress',
                'opportunity_status',
                'contact_method',
                'conversation_record'
            ]);
        });
    }
};
