<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            ['class' => 'JSS1'],
            ['class' => 'JSS2'],
            ['class' => 'JSS3'],
            ['class' => 'SS1'],
            ['class' => 'SS2'],
            ['class' => 'SS3'],
        ];
        
        DB::table('school_classes')->insert($classes);

    }
}
