<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::create($prefix.'supplier_quotations', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('party_type')->default('Supplier');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('supplier_name');
            $table->date('transaction_date');
            $table->date('valid_till')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('currency')->default('USD');
            $table->decimal('net_total', 21, 9)->default(0);
            $table->decimal('grand_total', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'supplier_quotations');
    }
};
