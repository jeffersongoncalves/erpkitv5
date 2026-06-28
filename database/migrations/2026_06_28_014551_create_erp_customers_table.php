<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'customers', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('customer_name')->unique();
            $table->foreignId('customer_group_id')->nullable()->constrained($prefix.'customer_groups')->nullOnDelete();
            $table->string('territory')->nullable();
            $table->string('customer_type')->default('Company');
            $table->string('default_currency')->default('USD');
            $table->foreignId('default_price_list_id')->nullable()->constrained($prefix.'price_lists')->nullOnDelete();
            $table->string('tax_id')->nullable();
            $table->decimal('credit_limit', 21, 9)->default(0);
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'customers');
    }
};
