<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::create($prefix.'asset_depreciation_schedules', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->foreignId('asset_id')->constrained($prefix.'assets')->cascadeOnDelete();
            $table->date('schedule_date');
            $table->decimal('depreciation_amount', 21, 9)->default(0);
            $table->decimal('accumulated_depreciation_amount', 21, 9)->default(0);
            $table->boolean('journal_entry_posted')->default(false);
            $table->boolean('gl_posted')->default(false);
            $table->timestamps();

            $table->index('schedule_date');
        });
    }

    public function down(): void
    {
        $prefix = config('erp-assets.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'asset_depreciation_schedules');
    }
};
