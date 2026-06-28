<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'product_bundle_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('product_bundle_id')->constrained($prefix.'product_bundles')->cascadeOnDelete();
            $table->string('item_code');
            $table->decimal('qty', 21, 9)->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'product_bundle_items');
    }
};
