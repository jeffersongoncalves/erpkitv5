<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::create($prefix.'subcontracting_boms', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('finished_good');
            $table->decimal('finished_good_qty', 21, 9)->default(1);
            $table->foreignId('bom_id')->nullable()->constrained($prefix.'boms')->nullOnDelete();
            $table->string('service_item')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-subcontracting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'subcontracting_boms');
    }
};
