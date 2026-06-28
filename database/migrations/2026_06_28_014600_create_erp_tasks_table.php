<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::create($prefix.'tasks', function (Blueprint $table) use ($prefix) {
            $table->id();
            $table->string('subject');
            $table->foreignId('project_id')->nullable()->constrained($prefix.'projects')->nullOnDelete();
            $table->string('status')->default('Open');
            $table->string('priority')->default('Medium');
            $table->foreignId('parent_task_id')->nullable()->constrained($prefix.'tasks')->nullOnDelete();
            $table->boolean('is_group')->default(false);
            $table->date('exp_start_date')->nullable();
            $table->date('exp_end_date')->nullable();
            $table->decimal('progress', 5, 2)->default(0);
            $table->decimal('expected_time', 21, 9)->default(0);
            $table->decimal('actual_time', 21, 9)->default(0);
            $table->foreignId('company_id')->nullable()->constrained($prefix.'companies')->nullOnDelete();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $prefix = config('erp-projects.table_prefix') ?? '';

        Schema::dropIfExists($prefix.'tasks');
    }
};
