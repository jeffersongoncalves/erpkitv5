<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::create($prefix.'maintenance_schedule_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('maintenance_schedule_id')->constrained($prefix.'maintenance_schedules')->cascadeOnDelete();
            $table->string('item_code');
            $table->string('item_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('periodicity')->default('Monthly');
            $table->unsignedInteger('no_of_visits')->default(1);
            $table->string('sales_person')->nullable();
            $table->string('serial_no')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'maintenance_schedule_items');
    }
};
