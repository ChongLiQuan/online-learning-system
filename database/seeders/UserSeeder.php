<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;


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
            'user_password' => Hash::make('690506070475'),
            'user_role' => '1',
            'user_full_name' => 'Shawn Tan Cheng',
            'user_email' => 'shawn@gmail.com.my',

        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'EDU_' . now()->year . '2',
            'user_password' => Hash::make('000506070473'),
            'user_role' => '1',
            'user_full_name' => 'Kelly Khoo Shin',
            'user_email' => 'kelly@gmail.com.my',
        ]);

        DB::table('student_list')->insert([
            'student_id' => 'STU_' . now()->year . '1',
            'student_name' => 'Roseane Kim',
            'student_IC' => '000506070475',
            'student_form' => '1',
            'student_age' => '13',
            'student_address' => '3-Z, Raffle Tower Bukit Jambul',
            'student_email' => 'rose@gmail.com',
            'student_gender' => 'female',
            'student_dob' => '2000-05-23',
            'student_class' => '1 Ariff',
            'parent_name' => 'Kim Yee Shang',
            'parent_IC' => '690506070475',
            'parent_hp' => '0185661788',
            'parent_occupation' => 'Doctor',
            'parent_age' => '56',
            'parent_address' => '3-Z, Raffle Tower Bukit Jambul',
            'relationship' => 'father',
            'parent_dob' => '1970-10-23'
        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'STU_' . now()->year . '1',
            'user_password' => Hash::make('000506070475'),
            'user_role' => '2',
            'user_full_name' => 'Roseane Kim',
            'user_email' => 'rose@gmail.com',
        ]);

        DB::table('student_list')->insert([
            'student_id' => 'STU_' . now()->year . '2',
            'student_name' => 'Yee Ching Sin',
            'student_IC' => '000766070349',
            'student_form' => '1',
            'student_age' => '13',
            'student_address' => 'Seoul, Korea Street',
            'student_email' => 'yee@gmail.com',
            'student_gender' => 'female',
            'student_dob' => '1996-05-23',
            'student_class' => '1 Ariff',
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
            'user_name' => 'STU_' . now()->year . '2',
            'user_password' => Hash::make('000766070349'),
            'user_role' => '2',
            'user_full_name' => 'Yee Ching Sin',
            'user_email' => 'yee@gmail.com',
        ]);

        DB::table('student_list')->insert([
            'student_id' => 'STU_' . now()->year . '3',
            'student_name' => 'Jisoo Rabbit Kim',
            'student_IC' => '000504030303',
            'student_form' => '1',
            'student_age' => '13',
            'student_address' => 'Taman Jelutong Condominium',
            'student_email' => 'jisoo@gmail.com',
            'student_gender' => 'female',
            'student_dob' => '2000-01-04',
            'student_class' => '1 Bestari',
            'parent_name' => 'Yeng Giseng Koo',
            'parent_IC' => '780926374812',
            'parent_hp' => '0121002929',
            'parent_occupation' => 'Engineer',
            'parent_age' => '46',
            'parent_address' => 'Taman Jelutong Condominium',
            'relationship' => 'Mother',
            'parent_dob' => '1978-03-02'
        ]);

        DB::table('user_login_details')->insert([
            'user_name' => 'STU_' . now()->year . '3',
            'user_password' => Hash::make('000504030303'),
            'user_role' => '2',
            'user_full_name' => 'Jisoo Rabbit Kim',
            'user_email' => 'jisoo@gmail.com',
        ]);



    }
}
