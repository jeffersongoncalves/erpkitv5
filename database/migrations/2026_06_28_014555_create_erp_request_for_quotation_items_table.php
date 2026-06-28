<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::create($prefix.'request_for_quotation_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('rfq_id')->constrained($prefix.'request_for_quotations')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->decimal('qty', 21, 9)->default(1);
            $table->foreignId('warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->date('schedule_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'request_for_quotation_items');
    }
};
