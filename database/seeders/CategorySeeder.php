<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik',    'product_id' => 1],
            ['name' => 'Aksesoris',     'product_id' => 2],
            ['name' => 'Peripheral',    'product_id' => 3],
            ['name' => 'Display',       'product_id' => 4],
            ['name' => 'Audio',         'product_id' => 5],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
