<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'delivery_note_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('delivery_note_id')->constrained($prefix.'delivery_notes')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->decimal('qty', 21, 9);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('warehouse_id')->constrained($prefix.'warehouses')->cascadeOnDelete();
            $table->string('against_sales_order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'delivery_note_items');
    }
};
