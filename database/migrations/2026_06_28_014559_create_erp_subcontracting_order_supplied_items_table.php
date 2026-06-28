<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_order_supplied_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('subcontracting_order_id')->constrained($prefix.'subcontracting_orders')->cascadeOnDelete();
            $table->string('main_item_code');
            $table->string('rm_item_code');
            $table->decimal('required_qty', 21, 9)->default(0);
            $table->decimal('supplied_qty', 21, 9)->default(0);
            $table->decimal('consumed_qty', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_order_supplied_items');
    }
};
