<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::create($prefix.'contracts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('party_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('Unsigned');
            $table->boolean('is_signed')->default(false);
            $table->longText('contract_terms')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'contracts');
    }
};
