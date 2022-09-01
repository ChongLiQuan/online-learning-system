<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('folder_list')->insert([
            'folder_id' => '1',
            'folder_name' => 'Week 1',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => 0
        ]);
    }
}
