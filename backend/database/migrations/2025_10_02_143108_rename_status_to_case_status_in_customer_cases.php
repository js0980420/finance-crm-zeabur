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
        Schema::table('customer_cases', function (Blueprint $table) {
            // Rename status to case_status
            $table->renameColumn('status', 'case_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_cases', function (Blueprint $table) {
            // Rename back to status
            $table->renameColumn('case_status', 'status');
        });
    }
};
