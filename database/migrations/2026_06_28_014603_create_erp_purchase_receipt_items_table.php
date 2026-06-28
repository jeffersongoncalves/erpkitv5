<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'purchase_receipt_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('purchase_receipt_id')->constrained($prefix.'purchase_receipts')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->decimal('qty', 21, 9);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('warehouse_id')->constrained($prefix.'warehouses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'purchase_receipt_items');
    }
};
