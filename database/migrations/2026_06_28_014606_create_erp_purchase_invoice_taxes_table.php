<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'purchase_invoice_taxes', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('purchase_invoice_id')->constrained($prefix.'purchase_invoices')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('rate', 7, 4)->default(0);
            $table->decimal('tax_amount', 21, 9)->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'purchase_invoice_taxes');
    }
};
