<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'boms', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->decimal('quantity', 21, 9)->default(1);
            $table->foreignId('uom_id')->nullable()->constrained($prefix.'uoms')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->boolean('with_operations')->default(false);
            $table->string('currency')->default('USD');
            $table->decimal('total_cost', 21, 9)->default(0);
            $table->decimal('operating_cost', 21, 9)->default(0);
            $table->decimal('raw_material_cost', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'boms');
    }
};
