<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TourType;
use Faker\Generator as Faker;

$factory->define(TourType::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'description' => $faker->sentence
    ];
});
