<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    $schedule = App\Schedule::inRandomOrder()->get()[0];

    return [
        'user_id' => 1,
        'schedule_id' => $schedule->id,
        'value' => $schedule->services()->sum('price'),
        'type' => array_rand([0, 1, 2])
    ];
});
