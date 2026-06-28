<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::create($prefix.'workstations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('hour_rate', 21, 9)->default(0);
            $table->integer('production_capacity')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-manufacturing.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'workstations');
    }
};
