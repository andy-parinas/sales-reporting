<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use Faker\Generator as Faker;

$factory->define(Commission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' =>$faker->words(5, true),
    ];
});
