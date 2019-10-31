<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deduction;
use App\SalesReport;
use Faker\Generator as Faker;

$factory->define(Deduction::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'type' => $faker->numberBetween(1,3),
        'amount' => $faker->randomFloat()
    ];
});
