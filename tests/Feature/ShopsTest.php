<?php

use App\Models\Shop;
use App\Models\User;

test('authenticated users can create a shop', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('shops.store'), [
        'name'                     => 'Downtown Print Hub',
        'normal_print_price'       => 1,
        'color_print_price'        => 2,
        'double_sided_print_price' => 3,
    ]);

    $response->assertRedirect(route('shops'));
    $this->assertDatabaseHas('shops', [
        'name'       => 'Downtown Print Hub',
        'user_id'    => $user->id,
        'created_by' => $user->id,
    ]);

    expect(Shop::query()->where('name', 'Downtown Print Hub')->first()->uuid)->not->toBeEmpty();
});

test('shop creation validates required fields', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('shops.store'), []);

    $response->assertSessionHasErrors([
        'name',
        'normal_print_price',
        'color_print_price',
        'double_sided_print_price',
    ]);
    $this->assertDatabaseCount('shops', 0);
});
