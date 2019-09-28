<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductType;
use Faker\Generator as Faker;

$factory->define(ProductType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'code' => $faker->randomDigit
    ];
});
