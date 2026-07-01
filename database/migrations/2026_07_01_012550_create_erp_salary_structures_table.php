<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';
        $corePrefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'salary_structures', function (Blueprint $table) use ($corePrefix) {
            $table->id();
            $table->string('name');
            $table->foreignId('company_id')->nullable()->constrained($corePrefix.'companies')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('docstatus')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-hr.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'salary_structures');
    }
};
