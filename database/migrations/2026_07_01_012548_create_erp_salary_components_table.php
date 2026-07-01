<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';
        $accountingPrefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'salary_components', function (Blueprint $table) use ($accountingPrefix) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('Earning');
            $table->foreignId('account_id')->nullable()->constrained($accountingPrefix.'accounts')->nullOnDelete();
            $table->boolean('is_taxable')->default(false);
            $table->decimal('amount', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'salary_components');
    }
};
