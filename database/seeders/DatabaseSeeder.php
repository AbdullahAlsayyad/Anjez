<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin user
        User::updateOrCreate(
            ['email' => 'admin@anjez.com'],
            [
                'name'     => 'مدير المنصة',
                'password' => Hash::make('password123'),
            ]
        );

        $this->call([
            ServiceSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
