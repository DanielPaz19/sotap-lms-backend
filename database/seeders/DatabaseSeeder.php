<?php

namespace Database\Seeders;

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
        \App\Models\Student::factory(20)->create();
        \App\Models\Teacher::factory(5)->create();
        \App\Models\Subject::factory(10)->create();
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
