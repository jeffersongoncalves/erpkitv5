<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::create($prefix.'maintenance_visit_purposes', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('maintenance_visit_id')->constrained($prefix.'maintenance_visits')->cascadeOnDelete();
            $table->string('item_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->text('description')->nullable();
            $table->text('work_done')->nullable();
            $table->string('service_person')->nullable();
            $table->string('purpose_type')->default('Maintenance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'maintenance_visit_purposes');
    }
};
