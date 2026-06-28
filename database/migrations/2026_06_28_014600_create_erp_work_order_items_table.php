<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'work_order_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('work_order_id')->constrained($prefix.'work_orders')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->foreignId('source_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->decimal('required_qty', 21, 9)->default(0);
            $table->decimal('transferred_qty', 21, 9)->default(0);
            $table->decimal('consumed_qty', 21, 9)->default(0);
            $table->decimal('rate', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'work_order_items');
    }
};
