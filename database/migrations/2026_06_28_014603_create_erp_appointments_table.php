<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::create($prefix.'appointments', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->dateTime('scheduled_time');
            $table->string('status')->default('Open');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('party_type')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'appointments');
    }
};
