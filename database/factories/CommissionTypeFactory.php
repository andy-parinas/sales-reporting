<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CommissionType;
use Faker\Generator as Faker;

$factory->define(CommissionType::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'code' => $faker->numberBetween(1,2)
    ];
});
