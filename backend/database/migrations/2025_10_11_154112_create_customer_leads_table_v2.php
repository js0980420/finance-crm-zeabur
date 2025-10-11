<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LeadStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->string('case_status')->default(LeadStatus::Pending->value);
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->string('channel')->nullable();
            $table->string('source')->nullable();
            $table->string('website')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('line_id')->nullable();
            $table->string('line_display_name')->nullable();
            $table->string('loan_purpose')->nullable();
            $table->string('business_level')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('payload')->nullable();
            $table->boolean('is_suspected_blacklist')->default(false);
            $table->text('suspected_reason')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('assigned_at')->nullable();

            // Personal Info
            $table->date('birth_date')->nullable();
            $table->string('id_number')->nullable();
            $table->string('education')->nullable();
            $table->string('case_number')->nullable();

            // Contact Info (New Structure)
            $table->string('city')->nullable(); // 縣市
            $table->string('district')->nullable(); // 行政區
            $table->string('street')->nullable(); // 街道
            $table->string('landline_phone')->nullable();
            $table->boolean('comm_address_same_as_home')->default(false);
            $table->string('comm_address')->nullable();
            $table->string('residence_duration')->nullable();
            $table->string('residence_owner')->nullable();
            $table->string('telecom_operator')->nullable();

            // Company Info
            $table->string('company_name')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address')->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->boolean('has_labor_insurance')->nullable();
            $table->string('company_tenure')->nullable();

            // Loan Info
            $table->decimal('demand_amount', 15, 2)->nullable();
            $table->decimal('loan_amount', 15, 2)->nullable();
            $table->string('loan_type')->nullable();
            $table->string('loan_term')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable();

            // Emergency Contacts
            $table->string('emergency_contact_1_name')->nullable();
            $table->string('emergency_contact_1_relationship')->nullable();
            $table->string('emergency_contact_1_phone')->nullable();
            $table->string('contact_time_1')->nullable();
            $table->boolean('confidential_1')->default(false);
            $table->string('emergency_contact_2_name')->nullable();
            $table->string('emergency_contact_2_relationship')->nullable();
            $table->string('emergency_contact_2_phone')->nullable();
            $table->string('contact_time_2')->nullable();
            $table->boolean('confidential_2')->default(false);

            // Other
            $table->string('referrer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_leads');
    }
};