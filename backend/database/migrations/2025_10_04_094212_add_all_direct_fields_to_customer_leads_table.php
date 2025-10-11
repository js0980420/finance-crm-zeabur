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
            // 個人資料
            if (!Schema::hasColumn('customer_leads', 'birth_date')) {
                $table->date('birth_date')->nullable()->after('customer_name');
            }
            if (!Schema::hasColumn('customer_leads', 'id_number')) {
                $table->string('id_number', 20)->nullable()->after('birth_date');
            }
            if (!Schema::hasColumn('customer_leads', 'education')) {
                $table->string('education', 50)->nullable()->after('id_number');
            }
            if (!Schema::hasColumn('customer_leads', 'case_number')) {
                $table->string('case_number', 50)->nullable()->after('id');
            }

            // 聯絡資訊
            if (!Schema::hasColumn('customer_leads', 'customer_region')) {
                $table->string('customer_region', 50)->nullable()->after('education');
            }
            if (!Schema::hasColumn('customer_leads', 'home_address')) {
                $table->text('home_address')->nullable()->after('customer_region');
            }
            if (!Schema::hasColumn('customer_leads', 'landline_phone')) {
                $table->string('landline_phone', 20)->nullable()->after('home_address');
            }
            if (!Schema::hasColumn('customer_leads', 'comm_address_same_as_home')) {
                $table->boolean('comm_address_same_as_home')->default(false)->after('landline_phone');
            }
            if (!Schema::hasColumn('customer_leads', 'comm_address')) {
                $table->text('comm_address')->nullable()->after('comm_address_same_as_home');
            }
            if (!Schema::hasColumn('customer_leads', 'comm_phone')) {
                $table->string('comm_phone', 20)->nullable()->after('comm_address');
            }
            if (!Schema::hasColumn('customer_leads', 'residence_duration')) {
                $table->string('residence_duration', 50)->nullable()->after('comm_phone');
            }
            if (!Schema::hasColumn('customer_leads', 'residence_owner')) {
                $table->string('residence_owner', 50)->nullable()->after('residence_duration');
            }
            if (!Schema::hasColumn('customer_leads', 'telecom_operator')) {
                $table->string('telecom_operator', 50)->nullable()->after('residence_owner');
            }

            // 公司資料
            if (!Schema::hasColumn('customer_leads', 'company_name')) {
                $table->string('company_name')->nullable()->after('telecom_operator');
            }
            if (!Schema::hasColumn('customer_leads', 'company_phone')) {
                $table->string('company_phone', 20)->nullable()->after('company_name');
            }
            if (!Schema::hasColumn('customer_leads', 'company_address')) {
                $table->text('company_address')->nullable()->after('company_phone');
            }
            if (!Schema::hasColumn('customer_leads', 'job_title')) {
                $table->string('job_title', 100)->nullable()->after('company_address');
            }
            if (!Schema::hasColumn('customer_leads', 'monthly_income')) {
                $table->decimal('monthly_income', 12, 2)->nullable()->after('job_title');
            }
            if (!Schema::hasColumn('customer_leads', 'has_labor_insurance')) {
                $table->boolean('has_labor_insurance')->nullable()->after('monthly_income');
            }
            if (!Schema::hasColumn('customer_leads', 'company_tenure')) {
                $table->string('company_tenure', 50)->nullable()->after('has_labor_insurance');
            }

            // 貸款資訊
            if (!Schema::hasColumn('customer_leads', 'demand_amount')) {
                $table->decimal('demand_amount', 12, 2)->nullable()->after('company_tenure');
            }
            if (!Schema::hasColumn('customer_leads', 'loan_amount')) {
                $table->decimal('loan_amount', 12, 2)->nullable()->after('demand_amount');
            }
            if (!Schema::hasColumn('customer_leads', 'loan_type')) {
                $table->string('loan_type', 50)->nullable()->after('loan_amount');
            }
            if (!Schema::hasColumn('customer_leads', 'loan_term')) {
                $table->integer('loan_term')->nullable()->after('loan_type');
            }
            if (!Schema::hasColumn('customer_leads', 'interest_rate')) {
                $table->decimal('interest_rate', 5, 2)->nullable()->after('loan_term');
            }

            // 緊急聯絡人 1
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_1_name')) {
                $table->string('emergency_contact_1_name', 100)->nullable()->after('interest_rate');
            }
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_1_relationship')) {
                $table->string('emergency_contact_1_relationship', 50)->nullable()->after('emergency_contact_1_name');
            }
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_1_phone')) {
                $table->string('emergency_contact_1_phone', 20)->nullable()->after('emergency_contact_1_relationship');
            }
            if (!Schema::hasColumn('customer_leads', 'contact_time_1')) {
                $table->string('contact_time_1', 50)->nullable()->after('emergency_contact_1_phone');
            }
            if (!Schema::hasColumn('customer_leads', 'confidential_1')) {
                $table->boolean('confidential_1')->default(false)->after('contact_time_1');
            }

            // 緊急聯絡人 2
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_2_name')) {
                $table->string('emergency_contact_2_name', 100)->nullable()->after('confidential_1');
            }
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_2_relationship')) {
                $table->string('emergency_contact_2_relationship', 50)->nullable()->after('emergency_contact_2_name');
            }
            if (!Schema::hasColumn('customer_leads', 'emergency_contact_2_phone')) {
                $table->string('emergency_contact_2_phone', 20)->nullable()->after('emergency_contact_2_relationship');
            }
            if (!Schema::hasColumn('customer_leads', 'contact_time_2')) {
                $table->string('contact_time_2', 50)->nullable()->after('emergency_contact_2_phone');
            }
            if (!Schema::hasColumn('customer_leads', 'confidential_2')) {
                $table->boolean('confidential_2')->default(false)->after('contact_time_2');
            }

            // 其他
            if (!Schema::hasColumn('customer_leads', 'referrer')) {
                $table->string('referrer', 100)->nullable()->after('confidential_2');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_leads', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'id_number',
                'education',
                'case_number',
                'customer_region',
                'home_address',
                'landline_phone',
                'comm_address_same_as_home',
                'comm_address',
                'comm_phone',
                'residence_duration',
                'residence_owner',
                'telecom_operator',
                'company_name',
                'company_phone',
                'company_address',
                'job_title',
                'monthly_income',
                'has_labor_insurance',
                'company_tenure',
                'demand_amount',
                'loan_amount',
                'loan_type',
                'loan_term',
                'interest_rate',
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
                'referrer',
            ]);
        });
    }
};
