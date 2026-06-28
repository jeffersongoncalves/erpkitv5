<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_receipt_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('subcontracting_receipt_id')->constrained($prefix.'subcontracting_receipts')->cascadeOnDelete();
            $table->string('item_code');
            $table->decimal('qty', 21, 9)->default(1);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->foreignId('bom_id')->nullable()->constrained($prefix.'boms')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_receipt_items');
    }
};
