<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'john@example.com'],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'password' => Hash::make('password123')
            ]
        );

        User::updateOrCreate(
            ['email' => 'jane@example.com'],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'password' => Hash::make('password123')
            ]
        );

        User::updateOrCreate(
            ['email' => 'bob@example.com'],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'password' => Hash::make('password123')
            ]
        );
    }
}
