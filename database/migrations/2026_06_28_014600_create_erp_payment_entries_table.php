<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'payment_entries', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->string('payment_type');
            $table->date('posting_date');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->string('party_type')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('party_name')->nullable();
            $table->foreignId('paid_from_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->foreignId('paid_to_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('paid_amount', 21, 9);
            $table->decimal('received_amount', 21, 9)->default(0);
            $table->string('reference_no')->nullable();
            $table->date('reference_date')->nullable();
            $table->foreignId('mode_of_payment_id')->nullable()->constrained($prefix.'modes_of_payment')->nullOnDelete();
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'payment_entries');
    }
};
