<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_list')->insert([
            'form_id' => '1',
            'form_name' => 'Form 1',
            'form_level' => '1',
        ]);

        DB::table('form_list')->insert([
            'form_id' => '2',
            'form_name' => 'Form 2',
            'form_level' => '2',
        ]);

        DB::table('form_list')->insert([
            'form_id' => '3',
            'form_name' => 'Form 3',
            'form_level' => '3',
        ]);

        DB::table('form_list')->insert([
            'form_id' => '4',
            'form_name' => 'Form 4',
            'form_level' => '4',
        ]);

        DB::table('form_list')->insert([
            'form_id' => '5',
            'form_name' => 'Form 5',
            'form_level' => '5',
        ]);
    }
}
