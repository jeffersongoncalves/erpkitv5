<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_order_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('subcontracting_order_id')->constrained($prefix.'subcontracting_orders')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->decimal('qty', 21, 9)->default(1);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('bom_id')->nullable()->constrained($prefix.'boms')->nullOnDelete();
            $table->decimal('received_qty', 21, 9)->default(0);
            $table->foreignId('fg_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_order_items');
    }
};
