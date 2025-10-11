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
        // 移除 customer_leads 表的 comm_phone 欄位
        if (Schema::hasColumn('customer_leads', 'comm_phone')) {
            Schema::table('customer_leads', function (Blueprint $table) {
                $table->dropColumn('comm_phone');
            });
        }

        // 移除 customer_cases 表的 comm_phone 欄位
        if (Schema::hasColumn('customer_cases', 'comm_phone')) {
            Schema::table('customer_cases', function (Blueprint $table) {
                $table->dropColumn('comm_phone');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 還原 customer_leads 表的 comm_phone 欄位
        if (!Schema::hasColumn('customer_leads', 'comm_phone')) {
            Schema::table('customer_leads', function (Blueprint $table) {
                $table->string('comm_phone', 20)->nullable()->after('comm_address');
            });
        }

        // 還原 customer_cases 表的 comm_phone 欄位
        if (!Schema::hasColumn('customer_cases', 'comm_phone')) {
            Schema::table('customer_cases', function (Blueprint $table) {
                $table->string('comm_phone', 20)->nullable()->after('comm_address');
            });
        }
    }
};
