<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::create($prefix.'opportunities', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('opportunity_from')->default('Lead');
            $table->foreignId('lead_id')->nullable()->constrained($prefix.'leads')->nullOnDelete();
            $table->string('party_type')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
            $table->string('party_name')->nullable();
            $table->string('status')->default('Open');
            $table->string('opportunity_type')->default('Sales');
            $table->decimal('opportunity_amount', 21, 9)->default(0);
            $table->decimal('probability', 5, 2)->default(0);
            $table->date('expected_closing')->nullable();
            $table->foreignId('campaign_id')->nullable()->constrained($prefix.'campaigns')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-crm.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'opportunities');
    }
};
