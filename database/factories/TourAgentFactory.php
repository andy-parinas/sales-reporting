<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TourAgent;
use Faker\Generator as Faker;

$factory->define(TourAgent::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber
    ];
});
