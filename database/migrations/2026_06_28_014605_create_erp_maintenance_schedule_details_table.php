<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::create($prefix.'maintenance_schedule_details', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('maintenance_schedule_id')->constrained($prefix.'maintenance_schedules')->cascadeOnDelete();
            $table->string('item_code');
            $table->date('scheduled_date');
            $table->string('completion_status')->default('Pending');
            $table->string('serial_no')->nullable();
            $table->string('sales_person')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'maintenance_schedule_details');
    }
};
