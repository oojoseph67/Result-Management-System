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
        // \App\Models\User::factory(10)->create();
        // $this->call(UsersTableSeeder::class);
        //\App\Models\User::factory(50)->create();
        // \App\Models\SchoolClass::factory(10)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(SchoolClassTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        // $this->call(AssignTeacherTableSeeder::class);
        // $this->call(ResultTableSeeder::class);
        // $this->call(AcademicResultTableSeeder::class);

    }
}