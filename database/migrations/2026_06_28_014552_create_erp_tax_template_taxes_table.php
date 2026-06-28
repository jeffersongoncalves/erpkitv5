<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'tax_template_taxes', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('tax_template_id')->constrained($prefix.'tax_templates')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('rate', 7, 4);
            $table->string('description')->nullable();
            $table->string('charge_type')->default('On Net Total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'tax_template_taxes');
    }
};
