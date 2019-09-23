<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3,true),
        'description' => $faker->paragraph,
        'product_type_id' => 1,
        'price' => $faker->randomFloat(2,100,10000)
    ];
});
