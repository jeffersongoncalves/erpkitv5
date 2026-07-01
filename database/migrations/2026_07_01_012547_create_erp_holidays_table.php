<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::create($prefix.'holidays', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('holiday_list_id')->constrained($prefix.'holiday_lists')->cascadeOnDelete();
            $table->date('holiday_date')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'holidays');
    }
};
