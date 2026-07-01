<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::create($prefix.'salary_structure_components', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('salary_structure_id')->constrained($prefix.'salary_structures')->cascadeOnDelete();
            $table->foreignId('salary_component_id')->constrained($prefix.'salary_components')->cascadeOnDelete();
            $table->decimal('amount', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'salary_structure_components');
    }
};
