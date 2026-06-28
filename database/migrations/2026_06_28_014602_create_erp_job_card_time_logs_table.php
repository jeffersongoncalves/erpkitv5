<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'job_card_time_logs', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('job_card_id')->constrained($prefix.'job_cards')->cascadeOnDelete();
            $table->dateTime('from_time')->nullable();
            $table->dateTime('to_time')->nullable();
            $table->decimal('time_in_mins', 21, 9)->default(0);
            $table->decimal('completed_qty', 21, 9)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'job_card_time_logs');
    }
};
