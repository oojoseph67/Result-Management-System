<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

       // User::factory()->count(50)->create();
        
        DB::table('users')->insert([
            [
                'name' => 'Super-Admin',
                'email' => 'superadmin@rms.com',
                'password' => bcrypt('password'),
                'role' => 'super-admin',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@rms.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@rms.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Admin3',
                'email' => 'admin3@rms.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'DataOperator1',
                'email' => 'dop@rms.com',
                'password' => bcrypt('password'),
                'role' => 'data-operator',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'DataOperator2',
                'email' => 'dop2@rms.com',
                'password' => bcrypt('password'),
                'role' => 'data-operator',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'DataOperator3',
                'email' => 'dop3@rms.com',
                'password' => bcrypt('password'),
                'role' => 'data-operator',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Teacher1',
                'email' => 'tec@rms.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Teacher2',
                'email' => 'tec2@rms.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Teacher3',
                'email' => 'tec3@rms.com',
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'dob' => $faker->dateTimeBetween($startDate = '-55 years', $endDate = '-20 years'),
                'entry_class' => 'none',
                'current_class' => 'none',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Student1',
                'email' => 'stu1@rms.com',
                'password' => bcrypt('password'),
                'role' => 'student',
                'dob' => $faker->dateTimeBetween($startDate = '-20 years', $endDate = '-10 years'),
                'entry_class' => 'SS1',
                'current_class' => 'SS2',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
            [
                'name' => 'Student2',
                'email' => 'stu2@rms.com',
                'password' => bcrypt('password'),
                'role' => 'student',
                'dob' => $faker->dateTimeBetween($startDate = '-20 years', $endDate = '-10 years'),
                'entry_class' => 'JSS3',
                'current_class' => 'SS1',
                'session' => '2020/2021',
                'term' => 'First Term',
                'passport_path' => $faker->imageUrl(640, 480)
            ],
        ]);
    }
}
