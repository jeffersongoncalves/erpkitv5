<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('symbol')->nullable();
            $table->string('fraction')->nullable();
            $table->unsignedInteger('fraction_units')->nullable();
            $table->string('number_format')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'currencies');
    }
};
