<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'schedule_id' => factory(App\Schedule::class)->create()->id,
        'value' => $faker->numberBetween(10, 100),
        'type' => 0
    ];
});
