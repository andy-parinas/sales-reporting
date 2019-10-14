<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\SalesReport;
use App\SelectedProduct;
use Faker\Generator as Faker;

$factory->define(SelectedProduct::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class),
        'sales_report_id' => factory(SalesReport::class),
        'price' => $faker->randomFloat(2),
        'cost' => $faker->randomFloat(2),
        'quantity' => $faker->randomDigit,
        'total' => $faker->randomFloat(2)
    ];
});
