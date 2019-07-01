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
        $admin = factory(App\User::class)->create([
            'email' => 'admin@test.com'
        ]);

        factory(App\Service::class, 20)->create(['user_id' => $admin->id])->each(function ($service) use ($admin) {
            $schedule = factory(App\Schedule::class)->create([
                'user_id' => $admin->id
            ]);

            $schedule->services()->attach($schedule->id);
        });

        factory(App\Reminder::class, 20)->create([
            'user_id' => $admin->id
        ]);
    }
}
