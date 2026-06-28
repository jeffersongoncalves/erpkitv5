<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::create($prefix.'price_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('currency')->default('USD');
            $table->boolean('enabled')->default(true);
            $table->boolean('is_selling')->default(false);
            $table->boolean('is_buying')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-stock.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'price_lists');
    }
};
