<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user if it doesn't exist
        \App\Models\User::firstOrCreate(
            ['email' => 'admin'],
            [
                'username' => 'admin',
                'first_name' => 'admin',
                'middle_name' => '',
                'last_name' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        // Create 10 random users if there are no other users
        if (\App\Models\User::count() <= 1) { 
            \App\Models\User::factory(10)->create();
        }

        // Seed Users
        $this->call(UserSeeder::class);

        // Seed Products
        $this->call(ProductSeeder::class);

        // Seed Orders
        $this->call(OrderSeeder::class);
    }
}
