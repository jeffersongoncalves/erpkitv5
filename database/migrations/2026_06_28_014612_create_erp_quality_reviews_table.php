<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_reviews', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('goal')->nullable();
            $table->foreignId('quality_goal_id')->nullable()->constrained($prefix.'quality_goals')->nullOnDelete();
            $table->date('date')->nullable();
            $table->string('status')->default('Open');
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_reviews');
    }
};
