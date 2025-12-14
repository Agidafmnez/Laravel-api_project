<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            ['user_id' => 1, 'total_price' => 1000, 'status' => 'pending'],
            ['user_id' => 2, 'total_price' => 1500, 'status' => 'completed'],
            ['user_id' => 3, 'total_price' => 500, 'status' => 'processing'],
            ['user_id' => 1, 'total_price' => 1200, 'status' => 'completed'],
            ['user_id' => 2, 'total_price' => 800, 'status' => 'pending'],
            ['user_id' => 3, 'total_price' => 2500, 'status' => 'completed'],
            ['user_id' => 1, 'total_price' => 700, 'status' => 'processing'],
            ['user_id' => 2, 'total_price' => 3000, 'status' => 'pending'],
            ['user_id' => 3, 'total_price' => 1800, 'status' => 'completed'],
            ['user_id' => 1, 'total_price' => 2200, 'status' => 'pending'],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}

