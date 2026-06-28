<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'bom_operations', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('bom_id')->constrained($prefix.'boms')->cascadeOnDelete();
            $table->foreignId('operation_id')->nullable()->constrained($prefix.'operations')->nullOnDelete();
            $table->foreignId('workstation_id')->nullable()->constrained($prefix.'workstations')->nullOnDelete();
            $table->decimal('time_in_mins', 21, 9)->default(0);
            $table->decimal('hour_rate', 21, 9)->default(0);
            $table->decimal('operating_cost', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'bom_operations');
    }
};
