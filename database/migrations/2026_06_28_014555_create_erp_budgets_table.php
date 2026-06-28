<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'budgets', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name');
            $table->foreignId('fiscal_year_id')->constrained($prefix.'fiscal_years')->cascadeOnDelete();
            $table->foreignId('cost_center_id')->nullable()->constrained($prefix.'cost_centers')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('applicable_on_material_request')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'budgets');
    }
};
