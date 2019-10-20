<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SalesReport;
use App\SummaryReport;
use App\SummaryReportItem;
use Faker\Generator as Faker;

$factory->define(SummaryReportItem::class, function (Faker $faker) {
    return [
        'summary_report_id' =>factory(SummaryReport::class),
        'sales_report_id' =>factory(SalesReport::class)
    ];
});
