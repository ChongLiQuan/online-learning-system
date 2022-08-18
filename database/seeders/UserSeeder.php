<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
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

        DB::table('student_list')->insert([
            'student_id' => 'STU_' . now()->year . '1',
            'student_name' => 'Marry Lim Teng Shen',
            'student_IC' => '000506070475',
            'student_form' => '5',
            'student_age' => '18',
            'student_address' => '3-Z, Raffle Tower Bukit Jambul',
            'student_email' => 'marry@gmail.com',
            'student_gender' => 'female',
            'student_dob' => '2000-05-23',
            'parent_name' => 'Lim Yee Shang',
            'parent_IC' => '690506070475',
            'parent_hp' => '0185661788',
            'parent_occupation' => 'Doctor',
            'parent_age' => '56',
            'parent_address' => '3-Z, Raffle Tower Bukit Jambul',
            'relationship' => 'father',
            'parent_dob' => '1970-10-23'
        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'STU' . now()->year . '1',
            'user_password' => '000506070475',
            'user_role' => '2',
            'name' => 'Marry Lim Teng Shen',
            'email' => 'marry@gmail.com',
        ]);

        DB::table('student_list')->insert([
            'student_id' => 'STU_' . now()->year . '2',
            'student_name' => 'Blackpink Rose',
            'student_IC' => '000766070349',
            'student_form' => '5',
            'student_age' => '18',
            'student_address' => 'Seoul, Korea Street',
            'student_email' => 'rose@gmail.com',
            'student_gender' => 'female',
            'student_dob' => '1996-05-23',
            'parent_name' => 'Ko Gram Bak',
            'parent_IC' => '650534560089',
            'parent_hp' => '019725462',
            'parent_occupation' => 'Singer',
            'parent_age' => '50',
            'parent_address' => 'Seoul, Korea Street',
            'relationship' => 'father',
            'parent_dob' => '1965-02-23'
        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'STU' . now()->year . '2',
            'user_password' => '000766070349',
            'user_role' => '2',
            'name' => 'Blackpink Rose',
            'email' => 'rose@gmail.com',
        ]);
    }
}
