<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Wireless Earbuds', 'Bluetooth Speaker', 'Smart Watch', 'Gaming Mouse',
                'Mechanical Keyboard', 'LED Monitor', 'Running Shoes', 'Sports Jacket',
                'Coffee Maker', 'Air Fryer', 'Laptop Stand', 'Power Bank', 'Smartphone Case',
                'USB Flash Drive', 'Wireless Charger', 'Fitness Tracker', 'Portable Fan',
                'Desk Lamp', 'Noise Cancelling Headphones', 'Smart TV', 'Smartphone Tripod',
                'HD Webcam', 'Gaming Chair', 'Wireless Router', 'External Hard Drive',
                'Mini Projector', 'Smart Home Plug', 'Robot Vacuum', 'Electric Toothbrush',
                'Hair Dryer', 'Steam Iron', 'Smart Light Bulb', 'Portable Blender',
                'Electric Kettle', 'Yoga Mat', 'Camping Tent', 'Water Bottle', 'Bluetooth Keyboard',
                'VR Headset', 'Graphic Tablet', 'Laptop Cooling Pad', 'Microphone Stand',
                'DSLR Camera Bag', 'Tripod Stand', 'HDMI Cable', 'Smart Doorbell',
                'Wireless Security Camera', 'Dash Cam', 'Car Phone Holder', 'Portable Speaker',
                '3D Printer Pen', 'Sewing Machine', 'Drone with Camera', 'Smart Glasses',
            ]),

            'description'=> $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image_url' => null,
            'stock' => 100,
            // 'created_at' => now(),
            // 'updated_at' => now(),


        ];
    }
}
