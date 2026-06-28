<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::create($prefix.'asset_movements', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('naming_series')->nullable();
            $table->foreignId('asset_id')->constrained($prefix.'assets')->cascadeOnDelete();
            $table->string('purpose');
            $table->dateTime('transaction_date');
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            $table->string('from_custodian')->nullable();
            $table->string('to_custodian')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'asset_movements');
    }
};
