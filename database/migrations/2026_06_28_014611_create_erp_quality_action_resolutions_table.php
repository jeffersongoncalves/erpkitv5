<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_action_resolutions', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('quality_action_id')->constrained($prefix.'quality_actions')->cascadeOnDelete();
            $table->text('problem');
            $table->text('resolution')->nullable();
            $table->string('status')->default('Open');
            $table->string('responsible')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_action_resolutions');
    }
};
