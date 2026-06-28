<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'budget_accounts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('budget_id')->constrained($prefix.'budgets')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('budget_amount', 21, 9);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'budget_accounts');
    }
};
