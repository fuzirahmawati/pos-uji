<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'sku' => 'PRD001',
                'name' => 'Indomie Goreng',
                'purchase_price' => 2500,
                'sell_price' => 3500,
                'stock' => 100,
                'unit' => 'pcs',
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'sku' => 'PRD002',
                'name' => 'Aqua 600 ml',
                'purchase_price' => 2000,
                'sell_price' => 3000,
                'stock' => 80,
                'unit' => 'botol',
                'is_active' => true,
            ],
        ]);
    }
}