<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_inspection_readings', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('quality_inspection_id')->constrained($prefix.'quality_inspections')->cascadeOnDelete();
            $table->string('specification');
            $table->string('value')->nullable();
            $table->string('reading_value')->nullable();
            $table->string('status')->default('Accepted');
            $table->decimal('min_value', 21, 9)->nullable();
            $table->decimal('max_value', 21, 9)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_inspection_readings');
    }
};
