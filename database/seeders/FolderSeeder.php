<?php

namespace Database\Seeders;

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
            'folder_content' => '<p>The first week of content, exercise and powerpoint slides will be inside this folder.</p>',
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '2',
            'folder_name' => 'Week 2',
            'class_subject_id' => '1',
            'folder_content' => '<p>Topics to be covered: Poem, Past Tense and Present Tense.</p>',
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '3',
            'folder_name' => 'Week 3',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '4',
            'folder_name' => 'Week 4',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '5',
            'folder_name' => 'Week 5',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '6',
            'folder_name' => 'Week 1',
            'class_subject_id' => '2',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '7',
            'folder_name' => 'Week 2',
            'class_subject_id' => '2',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '8',
            'folder_name' => 'Week 3',
            'class_subject_id' => '2',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '9',
            'folder_name' => 'Week 4',
            'class_subject_id' => '2',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '10',
            'folder_name' => 'Week 5',
            'class_subject_id' => '2',
            'folder_content' => null,
            'subFolder' => 0
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '11',
            'folder_name' => 'Chapter 1 Material',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => '1'
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '12',
            'folder_name' => 'Chapter 1 Reading Materials',
            'class_subject_id' => '1',
            'folder_content' => '<p>These are additional reading materials, please read it if you want a more in-depth understanding.</p>',
            'subFolder' => '1'
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '13',
            'folder_name' => 'Chapter 2 Material',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => '2'
        ]);

        DB::table('folder_list')->insert([
            'folder_id' => '14',
            'folder_name' => 'Week 2 Reading Materials',
            'class_subject_id' => '1',
            'folder_content' => null,
            'subFolder' => '2'
        ]);
    }
}
