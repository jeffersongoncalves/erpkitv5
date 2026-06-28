<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'product_bundles', function (Blueprint $table) {
            $table->id();
            $table->string('new_item_code');
            $table->text('description')->nullable();
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'product_bundles');
    }
};
