<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Elektronik'],
            ['id' => 2, 'name' => 'Peralatan Kantor'],
            ['id' => 3, 'name' => 'Aksesoris Komputer'],
            ['id' => 4, 'name' => 'Gadget & Smartphone'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}
