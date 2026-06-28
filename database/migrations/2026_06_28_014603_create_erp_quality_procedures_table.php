<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_procedures', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('quality_procedure_name')->unique();
            $table->foreignId('parent_quality_procedure_id')->nullable()->constrained($prefix.'quality_procedures')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->string('process_owner')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_procedures');
    }
};
