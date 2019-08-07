<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'product_id' => rand(1,10),
        'user_id' => rand(1,10)
    ];
});
