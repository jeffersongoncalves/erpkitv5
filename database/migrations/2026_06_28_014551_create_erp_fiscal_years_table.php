<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'fiscal_years', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('year_start_date');
            $table->date('year_end_date');
            $table->boolean('is_short_year')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'fiscal_years');
    }
};
