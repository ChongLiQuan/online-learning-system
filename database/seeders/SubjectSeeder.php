<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_list')->insert([
            'subject_id' => '1',
            'subject_code' => 'ENG1',
            'subject_name' => 'English Form 1',
            'form_id' => '1',
        ]);

        DB::table('subject_list')->insert([
            'subject_id' => '2',
            'subject_code' => 'BM1',
            'subject_name' => 'Bahasa Melayu Form 1',
            'form_id' => '1',
        ]);

        DB::table('subject_list')->insert([
            'subject_id' => '3',
            'subject_code' => 'ENG2',
            'subject_name' => 'English Form 2',
            'form_id' => '2',
        ]);

        DB::table('subject_list')->insert([
            'subject_id' => '4',
            'subject_code' => 'BM2',
            'subject_name' => 'Bahasa Melayu Form 2',
            'form_id' => '2',
        ]);

        DB::table('subject_list')->insert([
            'subject_id' => '5',
            'subject_code' => 'ENG3',
            'subject_name' => 'English Form 3',
            'form_id' => '3',
        ]);

        DB::table('subject_list')->insert([
            'subject_id' => '6',
            'subject_code' => 'BM3',
            'subject_name' => 'Bahasa Melayu Form 3',
            'form_id' => '3',
        ]);
    }
}
