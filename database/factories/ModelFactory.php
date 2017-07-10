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
$factory->define(App\Models\Sellers::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
});

$factory->define(App\Models\Sales::class, function (Faker\Generator $faker) {
    $seller = App\Models\Sellers::pluck('id')->toArray();
    return [
        'price' => $faker->randomNumber(2),
        'seller_id' => $faker->randomElement($seller),
    ];
});
