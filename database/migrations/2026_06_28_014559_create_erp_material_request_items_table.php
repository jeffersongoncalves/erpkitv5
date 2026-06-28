<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'material_request_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('material_request_id')->constrained($prefix.'material_requests')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->decimal('qty', 21, 9);
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->foreignId('uom_id')->nullable()->constrained($prefix.'uoms')->nullOnDelete();
            $table->decimal('rate', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'material_request_items');
    }
};
