<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::create($prefix.'suppliers', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('supplier_name')->unique();
            $table->foreignId('supplier_group_id')->nullable()->constrained($prefix.'supplier_groups')->nullOnDelete();
            $table->string('supplier_type')->default('Company');
            $table->string('country')->nullable();
            $table->string('default_currency')->default('USD');
            $table->string('tax_id')->nullable();
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'suppliers');
    }
};
