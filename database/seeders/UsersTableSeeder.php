<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'name' => 'super-admin',
            'email' => 'superadmin@rms.com',
            'password' => bcrypt('password'),
            'role' => 'super-admin',
            'dob' => '1999-1-1',
            'passport_path' => 'unknown',
        ]);
    }
}
