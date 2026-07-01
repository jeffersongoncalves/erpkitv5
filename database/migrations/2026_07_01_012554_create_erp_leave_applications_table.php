<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::create($prefix.'leave_applications', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('employee_id')->constrained($prefix.'employees')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained($prefix.'leave_types')->cascadeOnDelete();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->decimal('total_leave_days', 8, 2)->default(0);
            $table->string('status')->default('Open');
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'leave_applications');
    }
};
