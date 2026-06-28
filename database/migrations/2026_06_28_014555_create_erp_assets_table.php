<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::create($prefix.'assets', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('asset_name');
            $table->string('item_code')->nullable();
            $table->foreignId('asset_category_id')->constrained($prefix.'asset_categories')->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('location')->nullable();
            $table->string('custodian')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('available_for_use_date')->nullable();
            $table->decimal('gross_purchase_amount', 21, 9)->default(0);
            $table->decimal('opening_accumulated_depreciation', 21, 9)->default(0);
            $table->string('depreciation_method')->nullable();
            $table->integer('total_number_of_depreciations')->default(0);
            $table->integer('frequency_of_depreciation')->default(12);
            $table->decimal('salvage_value', 21, 9)->default(0);
            $table->string('status')->default('Draft');
            $table->decimal('value_after_depreciation', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'assets');
    }
};
