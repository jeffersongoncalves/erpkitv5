<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'non_conformances', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('subject');
            $table->string('procedure')->nullable();
            $table->foreignId('quality_procedure_id')->nullable()->constrained($prefix.'quality_procedures')->nullOnDelete();
            $table->string('status')->default('Open');
            $table->longText('details')->nullable();
            $table->longText('corrective_action')->nullable();
            $table->longText('preventive_action')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'non_conformances');
    }
};
