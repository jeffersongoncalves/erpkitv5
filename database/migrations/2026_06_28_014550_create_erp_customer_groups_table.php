<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'customer_groups', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_customer_group_id')->nullable()->constrained($prefix.'customer_groups')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'customer_groups');
    }
};
