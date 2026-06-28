<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'bank_accounts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('account_name');
            $table->foreignId('bank_id')->constrained($prefix.'banks')->cascadeOnDelete();
            $table->string('account_no')->nullable();
            $table->foreignId('account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('is_default')->default(false);
            $table->boolean('is_company_account')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'bank_accounts');
    }
};
