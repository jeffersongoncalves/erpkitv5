<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'stock_ledger_entries', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained($prefix.'warehouses')->cascadeOnDelete();
            $table->dateTime('posting_date');
            $table->decimal('actual_qty', 21, 9);
            $table->decimal('qty_after_transaction', 21, 9);
            $table->decimal('incoming_rate', 21, 9)->default(0);
            $table->decimal('valuation_rate', 21, 9)->default(0);
            $table->decimal('stock_value', 21, 9)->default(0);
            $table->decimal('stock_value_difference', 21, 9)->default(0);
            $table->morphs('voucherable');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('is_cancelled')->default(false);
            $table->timestamps();

            $table->index(['item_id', 'warehouse_id', 'posting_date']);
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'stock_ledger_entries');
    }
};
