<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::create($prefix.'salary_structure_assignments', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('employee_id')->constrained($prefix.'employees')->cascadeOnDelete();
            $table->foreignId('salary_structure_id')->constrained($prefix.'salary_structures')->cascadeOnDelete();
            $table->date('from_date')->nullable();
            $table->decimal('base', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'salary_structure_assignments');
    }
};
