<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'stock_entry_details', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('stock_entry_id')->constrained($prefix.'stock_entries')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('s_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->foreignId('t_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->decimal('qty', 21, 9);
            $table->foreignId('uom_id')->nullable()->constrained($prefix.'uoms')->nullOnDelete();
            $table->decimal('basic_rate', 21, 9)->default(0);
            $table->decimal('valuation_rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'stock_entry_details');
    }
};
