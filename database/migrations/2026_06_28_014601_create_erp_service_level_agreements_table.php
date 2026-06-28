<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::create($prefix.'service_level_agreements', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('default_sla')->default(false);
            $table->boolean('enabled')->default(true);
            $table->string('default_priority')->default('Medium');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'service_level_agreements');
    }
};
