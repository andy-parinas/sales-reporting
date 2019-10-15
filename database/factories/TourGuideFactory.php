<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TourAgent;
use App\TourGuide;
use Faker\Generator as Faker;

$factory->define(TourGuide::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' =>$faker->email,
        'phone' => $faker->phoneNumber,
    ];
});
