<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deduction;
use App\SalesReport;
use Faker\Generator as Faker;

$factory->define(Deduction::class, function (Faker $faker) {
    return [
        'sales_report_id' => factory(SalesReport::class),
        'guide_incentive' => $faker->randomFloat(2),
        'delivery' => $faker->randomFloat(2),
        'service' => $faker->randomFloat(2),
        'total' => $faker->randomFloat(2)

    ];
});
