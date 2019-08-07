<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'name' => $faker->word,
        'price' => $faker->randomFloat(2,1.1,5432.54),
        'description' => $faker->text
    ];
});
