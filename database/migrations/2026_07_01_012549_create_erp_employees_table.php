<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';
        $corePrefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'employees', function (Blueprint $table) use ($corePrefix) {
            $table->id();
            $table->string('employee_number')->unique();
            $table->foreignId('company_id')->nullable()->constrained($corePrefix.'companies')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained($corePrefix.'departments')->nullOnDelete();
            $table->foreignId('designation_id')->nullable()->constrained($corePrefix.'designations')->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->string('status')->default('Active');
            $table->date('date_of_leaving')->nullable();
            $table->decimal('ctc', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'employees');
    }
};
