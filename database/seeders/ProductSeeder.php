<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop Asus',       'qty' => 10, 'price' => 7500000.00,  'user_id' => 1],
            ['name' => 'Mouse Logitech',    'qty' => 50, 'price' => 250000.00,   'user_id' => 2],
            ['name' => 'Keyboard Mechanical','qty' => 25, 'price' => 650000.00,  'user_id' => 3],
            ['name' => 'Monitor Samsung',   'qty' => 15, 'price' => 2800000.00,  'user_id' => 4],
            ['name' => 'Headset Sony',      'qty' => 30, 'price' => 450000.00,   'user_id' => 5],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
