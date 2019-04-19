<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'client' => $faker->name,
        'service' => $faker->word,
        'description' => $faker->paragraph
    ];
});
