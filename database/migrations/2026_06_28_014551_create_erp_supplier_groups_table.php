<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::create($prefix.'supplier_groups', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_supplier_group_id')->nullable()->constrained($prefix.'supplier_groups')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-buying.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'supplier_groups');
    }
};
