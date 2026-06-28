<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'sales_order_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained($prefix.'sales_orders')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('qty', 21, 9)->default(1);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->decimal('delivered_qty', 21, 9)->default(0);
            $table->decimal('billed_qty', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'sales_order_items');
    }
};
