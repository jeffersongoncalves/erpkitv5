<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::create($prefix.'asset_categories', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name')->unique();
            $table->string('depreciation_method')->default('Straight Line');
            $table->integer('total_number_of_depreciations')->default(0);
            $table->integer('frequency_of_depreciation')->default(12);
            $table->foreignId('depreciation_account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->foreignId('accumulated_depreciation_account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->foreignId('fixed_asset_account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'asset_categories');
    }
};
