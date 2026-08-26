<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);
    }
}