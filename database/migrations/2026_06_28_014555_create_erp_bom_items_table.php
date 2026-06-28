<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'bom_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('bom_id')->constrained($prefix.'boms')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->decimal('qty', 21, 9)->default(1);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('stock_uom_id')->nullable()->constrained($prefix.'uoms')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'bom_items');
    }
};
