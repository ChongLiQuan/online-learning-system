<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class EducatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('educator_list')->insert([
            'edu_id' =>  'EDU_' . now()->year . '1',
            'edu_name' => 'Shawn Tan Cheng',
            'edu_IC' => '690506070475',
            'edu_year' => '8',
            'edu_age' => '45',
            'edu_address' => '3-Z, Raffle Tower Bukit Jambul',
            'edu_email' => 'shawn@gmail.com.my',
            'edu_gender' => 'male',
            'edu_dob' => '1970-10-23'
        ]);

        DB::table('educator_list')->insert([
            'edu_id' => 'EDU_' . now()->year . '2',
            'edu_name' => 'Kelly Khoo Shin',
            'edu_IC' => '000506070473',
            'edu_year' => '5',
            'edu_age' => '35',
            'edu_address' => '1A, Taman Indah Greelane',
            'edu_email' => 'kelly@gmail.com.my',
            'edu_gender' => 'female',
            'edu_dob' => '1980-08-09'
        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'EDU_' . now()->year . '1',
            'user_password' => '690506070475',
            'user_role' => '1',
            'name' => 'Shawn Tan Cheng',
            'email' => 'shawn@gmail.com.my',

        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'EDU_' . now()->year . '2',
            'user_password' => '000506070473',
            'user_role' => '1',
            'name' => 'Kelly Khoo Shin',
            'email' => 'kelly@gmail.com.my',
        ]);
    }
}
