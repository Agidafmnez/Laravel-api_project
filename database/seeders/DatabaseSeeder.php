<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin'],
            [
                'username' => 'admin',
                'first_name' => 'admin',
                'middle_name' => '',
                'last_name' => 'admin',
                'password' => Hash::make('password'),
            ]
        );
        if (User::count() <= 1) { 
            \App\Models\User::factory(10)->create();
        }

        if (\App\Models\Product::count() === 0) {
            $this->call(ProductSeeder::class);
        }
       
        $this->call(OrderSeeder::class);  
        $this->call(UserSeeder::class);
    }

}