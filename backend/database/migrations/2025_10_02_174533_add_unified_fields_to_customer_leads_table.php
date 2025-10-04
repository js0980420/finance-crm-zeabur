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
        Schema::table('customer_leads', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('name');
            $table->string('line_display_name')->nullable()->after('line_id');
            $table->string('loan_purpose')->nullable()->after('line_display_name');
            $table->string('website')->nullable()->after('source');
            $table->string('business_level', 10)->nullable()->after('loan_purpose');
            $table->text('notes')->nullable()->after('payload');
            $table->unsignedBigInteger('created_by')->nullable()->after('notes');
            $table->timestamp('assigned_at')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_leads', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'line_display_name',
                'loan_purpose',
                'website',
                'business_level',
                'notes',
                'created_by',
                'assigned_at'
            ]);
        });
    }
};
