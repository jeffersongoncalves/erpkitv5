<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'sales_invoices', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('customer_name');
            $table->date('posting_date');
            $table->date('due_date')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('currency')->default('USD');
            $table->decimal('conversion_rate', 21, 9)->default(1);
            $table->foreignId('debit_to_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('net_total', 21, 9)->default(0);
            $table->decimal('total_taxes', 21, 9)->default(0);
            $table->decimal('grand_total', 21, 9)->default(0);
            $table->decimal('outstanding_amount', 21, 9)->default(0);
            $table->string('status')->default('Draft');
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'sales_invoices');
    }
};
