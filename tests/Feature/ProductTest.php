<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

it('has product page', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->get('/products');

    $response->assertStatus(200);
});

it('reduces product stock after successful transaction', function () {
    $user = User::factory()->create();

    $category = Category::create([
        'name' => 'Makanan',
        'slug' => 'makanan',
    ]);

    $product = Product::factory()->create([
        'category_id' => $category->id,
        'stock' => 10,
        'sell_price' => 5000,
    ]);

    $this->actingAs($user)
        ->post('/transactions', [
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 3,
                ],
            ],
            'paid_amount' => 15000,
        ])
        ->assertRedirect();

    expect($product->fresh()->stock)->toBe(7);
});