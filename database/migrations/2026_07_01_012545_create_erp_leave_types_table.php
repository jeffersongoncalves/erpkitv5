<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::create($prefix.'leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_leaves_allowed')->default(0);
            $table->boolean('is_paid')->default(true);
            $table->boolean('allow_negative')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'leave_types');
    }
};
