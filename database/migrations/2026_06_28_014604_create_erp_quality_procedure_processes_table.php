<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_procedure_processes', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('quality_procedure_id')->constrained($prefix.'quality_procedures')->cascadeOnDelete();
            $table->text('process_description');
            $table->string('role')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_procedure_processes');
    }
};
