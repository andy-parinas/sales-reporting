<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deduction;
use App\SalesDeduction;
use App\SalesReport;
use Faker\Generator as Faker;

$factory->define(SalesDeduction::class, function (Faker $faker) {
    return [
        'sales_report_id' => factory(SalesReport::class),
        'deduction_id' => factory(Deduction::class),
        'amount' => $faker->randomFloat(2)
    ];
});
