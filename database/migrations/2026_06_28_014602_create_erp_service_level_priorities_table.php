<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::create($prefix.'service_level_priorities', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('service_level_agreement_id')->constrained($prefix.'service_level_agreements')->cascadeOnDelete();
            $table->string('priority')->default('Medium');
            $table->integer('response_time')->default(0);
            $table->integer('resolution_time')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-support.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'service_level_priorities');
    }
};
