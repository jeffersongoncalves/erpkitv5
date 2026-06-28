<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'purchase_invoice_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('purchase_invoice_id')->constrained($prefix.'purchase_invoices')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('qty', 21, 9)->default(1);
            $table->decimal('rate', 21, 9)->default(0);
            $table->decimal('amount', 21, 9)->default(0);
            $table->foreignId('expense_account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->foreignId('cost_center_id')->nullable()->constrained($prefix.'cost_centers')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'purchase_invoice_items');
    }
};
