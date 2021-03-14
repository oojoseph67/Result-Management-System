<?php

namespace Database\Seeders;

use App\Models\AssignTeacher;
use Illuminate\Database\Seeder;

class AssignTeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssignTeacher::factory()->count(17)->create();
    }
}
