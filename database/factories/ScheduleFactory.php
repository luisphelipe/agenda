<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'client' => $faker->name,
        'schedule' => $faker->dateTimeBetween('now', '+10 days'),
        'description' => $faker->paragraph
    ];
});
