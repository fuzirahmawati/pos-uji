<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::insert([
            [
                'name' => 'Pelanggan Umum',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Budi',
                'phone' => '081298765432',
            ],
        ]);
    }
}