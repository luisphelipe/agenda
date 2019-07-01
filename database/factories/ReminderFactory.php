<?php

use Faker\Generator as Faker;

$factory->define(App\Reminder::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'text' => $faker->sentence,
        'date' => $faker->dateTimeBetween('now', '+10 days'),
        'description' => $faker->paragraph
    ];
});
