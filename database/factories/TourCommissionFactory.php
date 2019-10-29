<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use App\CommissionType;
use App\TourAgent;
use App\TourCommission;
use App\TourType;
use Faker\Generator as Faker;

$factory->define(TourCommission::class, function (Faker $faker) {
    return [
        'tour_agent_id' => factory(TourAgent::class),
        'tour_type_id' => factory(TourType::class),
        'commission_type_id' => factory(CommissionType::class),
        'commission_id' => factory(Commission::class),
        'amount' => $faker->numberBetween(0.1, 0.5)
    ];
});
