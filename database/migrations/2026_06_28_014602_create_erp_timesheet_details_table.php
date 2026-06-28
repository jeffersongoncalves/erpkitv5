<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::create($prefix.'timesheet_details', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('timesheet_id')->constrained($prefix.'timesheets')->cascadeOnDelete();
            $table->foreignId('activity_type_id')->nullable()->constrained($prefix.'activity_types')->nullOnDelete();
            $table->foreignId('task_id')->nullable()->constrained($prefix.'tasks')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained($prefix.'projects')->nullOnDelete();
            $table->dateTime('from_time')->nullable();
            $table->dateTime('to_time')->nullable();
            $table->decimal('hours', 21, 9)->default(0);
            $table->boolean('is_billable')->default(true);
            $table->decimal('billing_rate', 21, 9)->default(0);
            $table->decimal('billing_amount', 21, 9)->default(0);
            $table->decimal('costing_rate', 21, 9)->default(0);
            $table->decimal('costing_amount', 21, 9)->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'timesheet_details');
    }
};
