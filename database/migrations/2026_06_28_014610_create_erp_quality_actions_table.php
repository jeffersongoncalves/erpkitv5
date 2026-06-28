<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::create($prefix.'quality_actions', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('corrective_preventive')->default('Corrective');
            $table->string('status')->default('Open');
            $table->string('review')->nullable();
            $table->date('date')->nullable();
            $table->string('goal')->nullable();
            $table->string('procedure')->nullable();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-quality.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'quality_actions');
    }
};
