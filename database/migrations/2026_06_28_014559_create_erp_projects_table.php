<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::create($prefix.'projects', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('project_name')->unique();
            $table->string('status')->default('Open');
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->date('expected_start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->decimal('percent_complete', 5, 2)->default(0);
            $table->decimal('estimated_costing', 21, 9)->default(0);
            $table->decimal('total_billable_amount', 21, 9)->default(0);
            $table->decimal('total_billed_amount', 21, 9)->default(0);
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'projects');
    }
};
