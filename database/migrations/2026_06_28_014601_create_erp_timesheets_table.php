<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::create($prefix.'timesheets', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('employee')->nullable();
            $table->string('user')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('Draft');
            $table->decimal('total_hours', 21, 9)->default(0);
            $table->decimal('total_billable_hours', 21, 9)->default(0);
            $table->decimal('total_billable_amount', 21, 9)->default(0);
            $table->decimal('total_costing_amount', 21, 9)->default(0);
            $table->decimal('per_billed', 7, 2)->default(0);
            $table->foreignId('parent_project_id')->nullable()->constrained($prefix.'projects')->nullOnDelete();
            $table->unsignedBigInteger('sales_invoice_id')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'timesheets');
    }
};
