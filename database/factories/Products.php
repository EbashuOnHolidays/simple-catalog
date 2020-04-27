<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    /** @var \App\Models\Category $category */
    $category = \App\Models\Category::query()->inRandomOrder()->first();

    return [
        'category_id' => $category->id,
        'name'        => $faker->jobTitle,
        'desc'        => $faker->text,
        'price'       => $faker->numberBetween(500, 1200),
    ];
});
