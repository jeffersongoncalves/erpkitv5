<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'companies', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name');
            $table->string('abbr')->unique();
            $table->string('default_currency');
            $table->string('country')->nullable();
            $table->string('tax_id')->nullable();
            $table->foreignId('parent_company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'companies');
    }
};
