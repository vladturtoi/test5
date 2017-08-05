<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
	return [
        'name' => $faker->text(10),
        'type' => $faker->randomElement(\App\Utils\ProductUtils::TYPES),
        'description' => $faker->text(),
        'price' => $faker->randomFloat(2, 10, 100),
        'discount' => $faker->randomFloat(2, 1, 9),
    ];
});
