<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'batches', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('batch_id')->unique();
            $table->foreignId('item_id')->constrained($prefix.'items')->cascadeOnDelete();
            $table->date('expiry_date')->nullable();
            $table->date('manufacturing_date')->nullable();
            $table->decimal('batch_qty', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'batches');
    }
};
