<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('due_days')->default(0);
            $table->text('description')->nullable();
            $table->decimal('invoice_portion', 5, 2)->default(100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'payment_terms');
    }
};
