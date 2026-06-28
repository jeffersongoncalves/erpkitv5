<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'item_prices', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->foreignId('price_list_id')->constrained($prefix.'price_lists')->cascadeOnDelete();
            $table->decimal('rate', 21, 9);
            $table->string('currency')->default('USD');
            $table->date('valid_from')->nullable();
            $table->date('valid_upto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'item_prices');
    }
};
