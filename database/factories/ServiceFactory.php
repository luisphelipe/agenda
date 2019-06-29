<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence,
        'duration' => $faker->numberBetween(10, 60),
        'price' => $faker->numberBetween(20, 100),
        'description' => $faker->paragraph
    ];
});
