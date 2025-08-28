<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\Role::factory(3)->create();
        \App\Models\Subjects::factory(9)->create();
        \App\Models\User::factory(25)->create();
        \App\Models\Group::factory(5)->create();
        \App\Models\Kitbsd::factory(5)->create();
        \App\Models\Classroom::factory(5)->create();
        \App\Models\Student::factory(25)->create();
        \App\Models\Programme::factory(9)->create();
        \App\Models\Presences::factory(225)->create();
        \App\Models\Opinion::factory(225)->create();
    }
}
