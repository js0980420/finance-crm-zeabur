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
        Schema::create('tracking_schedules', function (Blueprint $table) {
            $table->id();

            // 關聯案件
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('customer_leads')->onDelete('cascade');

            // 負責業務
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');

            // 排程時間
            $table->dateTime('scheduled_at');

            // 追蹤狀態: pending_contact(待聯絡), contacted(已聯絡), rescheduled(改期), cancelled(取消)
            $table->string('status', 20)->default('pending_contact');

            // 聯絡結果
            $table->string('contact_result', 100)->nullable()->comment('聯絡結果: 成功接通、未接、忙線等');

            // 聯絡方式: phone(電話), line(LINE), email(郵件), in_person(面談)
            $table->string('contact_method', 20)->nullable();

            // 客戶反饋
            $table->text('customer_feedback')->nullable();

            // 下次追蹤事項
            $table->text('next_action')->nullable();

            // 備註
            $table->text('notes')->nullable();

            // 改期追蹤(如果此追蹤是從其他追蹤改期而來)
            $table->unsignedBigInteger('rescheduled_from_id')->nullable();
            $table->foreign('rescheduled_from_id')->references('id')->on('tracking_schedules')->onDelete('set null');

            // 實際聯絡時間
            $table->dateTime('contacted_at')->nullable();

            // 建立者
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();

            // 索引優化查詢
            $table->index(['lead_id', 'scheduled_at']);
            $table->index(['assigned_to', 'status']);
            $table->index(['scheduled_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_schedules');
    }
};
