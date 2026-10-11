<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'sku' => 'ELK-001',
                'name' => 'Smart TV 32 Inch',
                'price' => 2500000.00,
                'stock' => 15,
                'minimum_stock' => 3,
            ],
            [
                'category_id' => 3,
                'sku' => 'ACC-001',
                'name' => 'Keyboard Mechanical RGB',
                'price' => 450000.00,
                'stock' => 25,
                'minimum_stock' => 5,
            ],
            [
                'category_id' => 3,
                'sku' => 'ACC-002',
                'name' => 'Wireless Mouse Optical',
                'price' => 150000.00,
                'stock' => 40,
                'minimum_stock' => 10,
            ],
            [
                'category_id' => 2,
                'sku' => 'OFF-001',
                'name' => 'Kertas HVS A4 80gsm',
                'price' => 55000.00,
                'stock' => 100,
                'minimum_stock' => 20,
            ],
            [
                'category_id' => 1,
                'sku' => 'ELK-002',
                'name' => 'Kabel HDMI 4K Gold Plated',
                'price' => 75000.00,
                'stock' => 2, // Low stock alert!
                'minimum_stock' => 5,
            ],
            [
                'category_id' => 3,
                'sku' => 'ACC-003',
                'name' => 'Headset Gaming 7.1 Surround',
                'price' => 350000.00,
                'stock' => 3, // Low stock alert!
                'minimum_stock' => 5,
            ],
            [
                'category_id' => 4,
                'sku' => 'GGT-001',
                'name' => 'Fast Charger Type-C 65W',
                'price' => 210000.00,
                'stock' => 18,
                'minimum_stock' => 5,
            ],
        ];

        foreach ($products as $prod) {
            \App\Models\Product::updateOrCreate(['sku' => $prod['sku']], $prod);
        }
    }
}
