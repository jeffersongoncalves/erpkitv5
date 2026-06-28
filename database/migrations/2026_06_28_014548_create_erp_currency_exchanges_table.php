<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::create($prefix.'currency_exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency');
            $table->string('to_currency');
            $table->decimal('exchange_rate', 21, 9);
            $table->date('date');
            $table->timestamps();

            $table->unique(['from_currency', 'to_currency', 'date']);
        });
    }

    public function down(): void
    {
        $prefix = config('erp-core.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'currency_exchanges');
    }
};
