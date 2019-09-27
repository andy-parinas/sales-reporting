<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductType;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3,true),
        'description' => $faker->paragraph,
        'product_type_id' => factory(ProductType::class),
        'price' => $faker->randomFloat(2,100,10000),
        'cost' => $faker->randomFloat(2,10,100)
    ];
});
