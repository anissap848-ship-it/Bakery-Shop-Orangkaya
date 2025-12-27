<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Butter Croissant',
                'description' => 'Flaky, buttery French pastry',
                'category' => 'Sweet Pastries',
                'price' => 3.50,
                'stock' => 24,
            ],
            [
                'name' => 'Sourdough Bread',
                'description' => 'Traditional artisan sourdough',
                'category' => 'Artisan Breads',
                'price' => 6.00,
                'stock' => 12,
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate layer cake',
                'category' => 'Custom Cakes',
                'price' => 35.00,
                'stock' => 5,
            ],
            [
                'name' => 'Cinnamon Roll',
                'description' => 'Soft fluffy rolls',
                'category' => 'Sweet Pastries',
                'price' => 4.00,
                'stock' => 18,
            ],
            [
                'name' => 'French Baguette',
                'description' => 'Classic French bread',
                'category' => 'Artisan Breads',
                'price' => 4.50,
                'stock' => 15,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}