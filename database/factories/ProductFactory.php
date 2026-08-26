<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static $index = 0;

    public function definition(): array
    {
        $products = [
            'Indomie Goreng',
            'Indomie Soto',
            'Aqua 600 ml',
            'Le Minerale 600 ml',
            'Teh Botol Sosro',
            'Ultra Milk',
            'Mizone',
            'Pocari Sweat',
            'Kopi Kapal Api',
            'Good Day',
            'Roma Malkist',
            'Oreo',
            'Chitato',
            'Qtela',
            'Taro',
            'SilverQueen',
            'Beng Beng',
            'Rinso',
            'Pepsodent',
            'Lifebuoy'
        ];

        $purchasePrice = fake()->numberBetween(3000, 25000);
        $sellPrice = $purchasePrice + fake()->numberBetween(1000, 5000);

        $name = $products[self::$index % count($products)];
        self::$index++;

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'sku' => 'SKU-' . str_pad(self::$index, 4, '0', STR_PAD_LEFT),
            'name' => $name,
            'purchase_price' => $purchasePrice,
            'sell_price' => $sellPrice,
            'stock' => fake()->numberBetween(10, 100),
            'unit' => fake()->randomElement(['pcs', 'botol', 'bungkus', 'kotak']),
            'is_active' => true,
        ];
    }
}