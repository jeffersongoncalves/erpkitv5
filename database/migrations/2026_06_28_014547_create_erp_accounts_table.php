<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::create($prefix.'accounts', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('name');
            $table->string('account_number')->nullable();
            $table->foreignId('parent_account_id')->nullable()->constrained($prefix.'accounts')->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->string('root_type')->nullable();
            $table->string('account_type')->nullable();
            $table->string('account_currency')->nullable();
            $table->boolean('disabled')->default(false);
            $table->boolean('freeze_account')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-accounting.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'accounts');
    }
};
