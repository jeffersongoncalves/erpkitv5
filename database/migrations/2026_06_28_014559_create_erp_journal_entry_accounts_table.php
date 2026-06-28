<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'journal_entry_accounts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('journal_entry_id')->constrained($prefix.'journal_entries')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('debit', 21, 9)->default(0);
            $table->decimal('credit', 21, 9)->default(0);
            $table->foreignId('cost_center_id')->nullable()->constrained($prefix.'cost_centers')->nullOnDelete();
            $table->string('party_type')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('against_account')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'journal_entry_accounts');
    }
};
