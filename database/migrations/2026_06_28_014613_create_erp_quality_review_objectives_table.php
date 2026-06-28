<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_review_objectives', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('quality_review_id')->constrained($prefix.'quality_reviews')->cascadeOnDelete();
            $table->text('objective');
            $table->string('target')->nullable();
            $table->string('achieved')->nullable();
            $table->string('status')->default('Open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_review_objectives');
    }
};
