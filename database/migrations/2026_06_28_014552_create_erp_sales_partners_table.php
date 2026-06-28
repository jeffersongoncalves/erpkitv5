<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::create($prefix.'sales_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->decimal('commission_rate', 7, 4)->default(0);
            $table->string('partner_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-selling.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'sales_partners');
    }
};
