<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_inspections', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('inspection_type')->default('Incoming');
            $table->string('reference_type')->nullable();
            $table->string('reference_name')->nullable();
            $table->decimal('sample_size', 21, 9)->default(1);
            $table->foreignId('quality_inspection_template_id')->nullable()->constrained($prefix.'quality_inspection_templates')->nullOnDelete();
            $table->string('status')->default('Accepted');
            $table->string('inspected_by')->nullable();
            $table->date('report_date')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_inspections');
    }
};
