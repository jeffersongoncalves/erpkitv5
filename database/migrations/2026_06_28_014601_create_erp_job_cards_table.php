<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'job_cards', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->foreignId('work_order_id')->constrained($prefix.'work_orders')->cascadeOnDelete();
            $table->foreignId('operation_id')->nullable()->constrained($prefix.'operations')->nullOnDelete();
            $table->foreignId('workstation_id')->nullable()->constrained($prefix.'workstations')->nullOnDelete();
            $table->decimal('for_quantity', 21, 9)->default(0);
            $table->decimal('total_completed_qty', 21, 9)->default(0);
            $table->string('status')->default('Open');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'job_cards');
    }
};
