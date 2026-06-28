<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'bins', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained($prefix.'warehouses')->cascadeOnDelete();
            $table->decimal('actual_qty', 21, 9)->default(0);
            $table->decimal('valuation_rate', 21, 9)->default(0);
            $table->decimal('stock_value', 21, 9)->default(0);
            $table->decimal('reserved_qty', 21, 9)->default(0);
            $table->decimal('ordered_qty', 21, 9)->default(0);
            $table->json('fifo_queue')->nullable();
            $table->timestamps();

            $table->unique(['item_id', 'warehouse_id']);
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'bins');
    }
};
