<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commission;
use App\SummaryReport;
use Faker\Generator as Faker;

$factory->define(SummaryReport::class, function (Faker $faker) {
    return [
        'title' =>$faker->words(3,true),
        'from_date' =>$faker->date('d/m/Y'),
        'to_date' => $faker->date('d/m/Y'),
        'report_number' => $faker->randomNumber,
        'adult_count_total' => $faker->numberBetween(5,30),
        'children_count_total' => $faker->numberBetween(0, 10),
        'tc_count' => $faker->numberBetween(0, 10),
        'sales_total' => $faker->randomFloat(2),
        'commission_id' => factory(Commission::class),
        'commission' => $faker->randomFloat(2)
        // 'agent_commissions_total' => $faker->randomFloat(2),
        // 'gst_total' => $faker->randomFloat(2),
        // 'total' => $faker->randomFloat(2),
        // 'return' => $faker->randomFloat(2),
        // 'duvet_deduction' => $faker->randomFloat(2),
        // 'balance' => $faker->randomFloat(2)
    ];
});
