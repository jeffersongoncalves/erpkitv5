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

        Schema::create($prefix.'payroll_entries', function (Blueprint $table) use ($corePrefix) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained($corePrefix.'companies')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('payroll_frequency')->default('Monthly');
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'payroll_entries');
    }
};
