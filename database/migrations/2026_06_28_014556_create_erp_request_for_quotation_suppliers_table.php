<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::create($prefix.'request_for_quotation_suppliers', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('rfq_id')->constrained($prefix.'request_for_quotations')->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained($prefix.'suppliers')->cascadeOnDelete();
            $table->string('quote_status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'request_for_quotation_suppliers');
    }
};
