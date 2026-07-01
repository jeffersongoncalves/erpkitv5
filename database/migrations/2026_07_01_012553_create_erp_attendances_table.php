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

        Schema::create($prefix.'attendances', function (Blueprint $table) use ($prefix, $corePrefix) {
            $table->id();
            $table->foreignId('employee_id')->constrained($prefix.'employees')->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($corePrefix.'companies')->nullOnDelete();
            $table->date('attendance_date')->nullable();
            $table->string('status')->default('Present');
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'attendances');
    }
};
