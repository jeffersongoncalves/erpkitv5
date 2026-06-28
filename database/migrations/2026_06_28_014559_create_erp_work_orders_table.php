<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'work_orders', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('production_item');
            $table->string('item_name')->nullable();
            $table->foreignId('bom_id')->nullable()->constrained($prefix.'boms')->nullOnDelete();
            $table->decimal('qty', 21, 9)->default(1);
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('status')->default('Draft');
            $table->foreignId('wip_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->foreignId('fg_warehouse_id')->nullable()->constrained($prefix.'warehouses')->nullOnDelete();
            $table->dateTime('planned_start_date')->nullable();
            $table->decimal('produced_qty', 21, 9)->default(0);
            $table->decimal('material_transferred_for_manufacturing', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'work_orders');
    }
};
