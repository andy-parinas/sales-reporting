<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SalesReport;
use App\TourAgent;
use App\TourGuide;
use App\TourType;
use Faker\Generator as Faker;

$factory->define(SalesReport::class, function (Faker $faker) {
    return [
        'report_number' => $faker->randomNumber,
        'grp_code' => $faker->numerify('GRP #######'),
        'adult_count' => $faker->numberBetween(5,30),
        'children_count' => $faker->numberBetween(0, 10),
        'tour_agent_id' => factory(TourAgent::class),
        'tour_guide_id' => factory(TourGuide::class),
        'tour_type_id' => factory(TourType::class),
        'tc_name' => $faker->name,
        'tour_date' => $faker->date('d/m/Y'),
        'total_sales' => $faker->randomFloat(2),
        'total_agent_sales' => $faker->randomFloat(2),
        'total_commissions' => $faker->randomFloat(2),
        'total_deductions'=> $faker->randomFloat(2),
        'gst' => $faker->randomFloat(2),
        'grand_total_commission' => $faker->randomFloat(2)
    ];
});
