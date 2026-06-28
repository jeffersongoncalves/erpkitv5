<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::create($prefix.'issues', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('subject');
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('raised_by')->nullable();
            $table->string('status')->default('Open');
            $table->string('priority')->default('Medium');
            $table->foreignId('issue_type_id')->nullable()->constrained($prefix.'issue_types')->nullOnDelete();
            $table->foreignId('service_level_agreement_id')->nullable()->constrained($prefix.'service_level_agreements')->nullOnDelete();
            $table->string('agreement_status')->nullable();
            $table->date('opening_date')->nullable();
            $table->dateTime('resolution_date')->nullable();
            $table->dateTime('first_responded_on')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'issues');
    }
};
