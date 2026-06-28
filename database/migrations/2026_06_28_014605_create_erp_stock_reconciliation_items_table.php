<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'stock_reconciliation_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('stock_reconciliation_id')->constrained($prefix.'stock_reconciliations')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained($prefix.'warehouses')->cascadeOnDelete();
            $table->decimal('qty', 21, 9);
            $table->decimal('valuation_rate', 21, 9);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'stock_reconciliation_items');
    }
};
