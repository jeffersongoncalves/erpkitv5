<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Seeds both authentication guards (an Admin for the /admin panel and a
     * User for the /app panel) plus the ERP demo dataset. Idempotent.
     */
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            ['email' => 'admin@erpkit.test'],
            ['name' => 'ERPKit Admin', 'status' => true, 'password' => Hash::make('password')],
        );

        User::query()->updateOrCreate(
            ['email' => 'user@erpkit.test'],
            ['name' => 'ERPKit User', 'status' => true, 'password' => Hash::make('password')],
        );

        $this->call(ErpDemoSeeder::class);
    }
}
