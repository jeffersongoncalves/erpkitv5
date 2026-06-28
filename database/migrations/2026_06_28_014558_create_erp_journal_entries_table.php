<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'journal_entries', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->date('posting_date');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('voucher_type')->default('Journal Entry');
            $table->text('user_remark')->nullable();
            $table->decimal('total_debit', 21, 9)->default(0);
            $table->decimal('total_credit', 21, 9)->default(0);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'journal_entries');
    }
};
