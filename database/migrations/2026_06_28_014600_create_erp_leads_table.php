<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::create($prefix.'leads', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('lead_name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('status')->default('Lead');
            $table->foreignId('lead_source_id')->nullable()->constrained($prefix.'lead_sources')->nullOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained($prefix.'campaigns')->nullOnDelete();
            $table->string('territory')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->longText('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'leads');
    }
};
