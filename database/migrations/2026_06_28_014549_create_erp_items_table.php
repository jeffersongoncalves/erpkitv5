<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('item_code')->unique();
            $table->string('item_name');
            $table->string('item_group')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('stock_uom_id')->nullable()->constrained($prefix.'uoms')->nullOnDelete();
            $table->boolean('is_stock_item')->default(true);
            $table->string('valuation_method')->nullable();
            $table->decimal('standard_rate', 21, 9)->default(0);
            $table->foreignId('default_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained($prefix.'brands')->nullOnDelete();
            $table->boolean('has_batch_no')->default(false);
            $table->boolean('has_serial_no')->default(false);
            $table->boolean('disabled')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'items');
    }
};
