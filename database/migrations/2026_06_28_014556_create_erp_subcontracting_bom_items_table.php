<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_bom_items', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('subcontracting_bom_id')->constrained($prefix.'subcontracting_boms')->cascadeOnDelete();
            $table->string('item_code');
            $table->decimal('qty', 21, 9)->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_bom_items');
    }
};
