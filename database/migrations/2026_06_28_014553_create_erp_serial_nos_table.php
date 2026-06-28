<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'serial_nos', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('serial_no')->unique();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->string('status')->default('Active');
            $table->decimal('purchase_rate', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'serial_nos');
    }
};
