<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::create($prefix.'warranty_claims', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('party_type')->default('Customer');
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('item_code')->nullable();
            $table->longText('complaint')->nullable();
            $table->string('status')->default('Open');
            $table->date('complaint_date')->nullable();
            $table->date('resolution_date')->nullable();
            $table->longText('resolution_details')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'warranty_claims');
    }
};
