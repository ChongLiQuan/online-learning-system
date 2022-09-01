<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('class_list')->insert([
            'class_id' => '1',
            'class_name' => '1 Ariff',
            'form_id' => '1',
        ]);


        DB::table('class_list')->insert([
            'class_id' => '2',
            'class_name' => '1 Bestari',
            'form_id' => '1',
        ]);


        DB::table('class_list')->insert([
            'class_id' => '3',
            'class_name' => '2 Ariff',
            'form_id' => '2',
        ]);


        DB::table('class_list')->insert([
            'class_id' => '4',
            'class_name' => '2 Bestari',
            'form_id' => '2',
        ]);


        DB::table('class_list')->insert([
            'class_id' => '5',
            'class_name' => '3 Ariff',
            'form_id' => '3',
        ]);


        DB::table('class_list')->insert([
            'class_id' => '6',
            'class_name' => '3 Bestari',
            'form_id' => '3',
        ]);

        DB::table('class_subject_list')->insert([
            'id' => '1',
            'subject_code' => 'ENG1',
            'class_name' => '1 Ariff',
            'educator_id' => 'edu',
        ]);

        DB::table('class_subject_list')->insert([
            'id' => '2',
            'subject_code' => 'ENG1',
            'class_name' => '1 Bestari',
            'educator_id' => 'edu',
        ]);

        DB::table('class_subject_list')->insert([
            'id' => '3',
            'subject_code' => 'ENG2',
            'class_name' => '2 Bestari',
            'educator_id' => 'edu',
        ]);

    }
}
