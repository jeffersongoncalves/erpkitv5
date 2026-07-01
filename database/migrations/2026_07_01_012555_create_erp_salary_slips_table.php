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

        Schema::create($prefix.'salary_slips', function (Blueprint $table) use ($prefix, $corePrefix) {
            $table->id();
            $table->foreignId('employee_id')->constrained($prefix.'employees')->cascadeOnDelete();
            $table->foreignId('salary_structure_id')->nullable()->constrained($prefix.'salary_structures')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($corePrefix.'companies')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('posting_date')->nullable();
            $table->decimal('gross_pay', 21, 9)->default(0);
            $table->decimal('total_deduction', 21, 9)->default(0);
            $table->decimal('net_pay', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'salary_slips');
    }
};
