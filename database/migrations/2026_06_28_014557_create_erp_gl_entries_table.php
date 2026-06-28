<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'gl_entries', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->date('posting_date');
            $table->foreignId('account_id')->constrained($prefix.'accounts')->cascadeOnDelete();
            $table->decimal('debit', 21, 9)->default(0);
            $table->decimal('credit', 21, 9)->default(0);
            $table->morphs('voucherable');
            $table->string('against_account')->nullable();
            $table->string('party_type')->nullable();
            $table->unsignedBigInteger('party_id')->nullable();
            $table->foreignId('cost_center_id')->nullable()->constrained($prefix.'cost_centers')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->text('remarks')->nullable();
            $table->boolean('is_cancelled')->default(false);
            $table->timestamps();

            $table->index('posting_date');
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'gl_entries');
    }
};
