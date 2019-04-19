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
        
        factory(App\Schedule::class, 20)->create([
            'user_id' => $admin->id
        ]);
    }
}
