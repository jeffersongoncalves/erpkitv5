<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::create($prefix.'maintenance_visits', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->foreignId('maintenance_schedule_id')->nullable()->constrained($prefix.'maintenance_schedules')->nullOnDelete();
            $table->date('mntc_date')->nullable();
            $table->string('maintenance_type')->default('Scheduled');
            $table->string('completion_status')->default('Pending');
            $table->string('status')->default('Draft');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-maintenance.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'maintenance_visits');
    }
};
