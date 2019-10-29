<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use App\SalesCommission;
use App\SalesReport;
use App\TourCommission;
use Faker\Generator as Faker;

$factory->define(SalesCommission::class, function (Faker $faker) {
    return [
        'sales_report_id' => factory(SalesReport::class),
        'tour_commission_id' => factory(TourCommission::class),
        'amount' => $faker->randomFloat(2)
    ];
});
