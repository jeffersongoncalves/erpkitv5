<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_receipts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->foreignId('subcontracting_order_id')->nullable()->constrained($prefix.'subcontracting_orders')->nullOnDelete();
            $table->string('party_type')->default('Supplier');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('supplier_name');
            $table->dateTime('posting_date');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->foreignId('supplier_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->decimal('total_qty', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_receipts');
    }
};
