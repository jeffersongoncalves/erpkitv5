<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'bank_transactions', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->date('date');
            $table->foreignId('bank_account_id')->constrained($prefix.'bank_accounts')->cascadeOnDelete();
            $table->decimal('deposit', 21, 9)->default(0);
            $table->decimal('withdrawal', 21, 9)->default(0);
            $table->text('description')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('status')->default('Pending');
            $table->decimal('allocated_amount', 21, 9)->default(0);
            $table->decimal('unallocated_amount', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'bank_transactions');
    }
};
