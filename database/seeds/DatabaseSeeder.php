<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'email' => 'admin@test.com'
        ]);

        factory(App\Service::class, 20)->create()->each(function ($service) {
            $schedule = factory(App\Schedule::class)->create();

            $schedule->services()->attach($service->id);
        });

        factory(App\Service::class, 10)->create()->each(function ($service) {
            $schedule = factory(App\Schedule::class)->create();

            $schedule->services()->attach($service->id);

            factory(App\Payment::class)->create([
                'schedule_id' => $schedule->id,
                'value' => $service->price
            ]);
        });

        factory(App\Reminder::class, 20)->create();
    }
}
