<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::create($prefix.'activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('default_costing_rate', 21, 9)->default(0);
            $table->decimal('default_billing_rate', 21, 9)->default(0);
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'activity_types');
    }
};
