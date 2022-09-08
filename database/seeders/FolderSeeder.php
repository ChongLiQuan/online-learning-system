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
        
        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '1',
            'subject_folder_name' => 'Week 1',
            'class_subject_id' => '1',
            'subject_folder_content' => '<p>The first week of content, exercise and powerpoint slides will be inside this folder.</p>',
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '2',
            'subject_folder_name' => 'Week 2',
            'class_subject_id' => '1',
            'subject_folder_content' => '<p>Topics to be covered: Poem, Past Tense and Present Tense.</p>',
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '3',
            'subject_folder_name' => 'Week 3',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '4',
            'subject_folder_name' => 'Week 4',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '5',
            'subject_folder_name' => 'Week 5',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '6',
            'subject_folder_name' => 'Week 1',
            'class_subject_id' => '2',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '7',
            'subject_folder_name' => 'Week 2',
            'class_subject_id' => '2',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '8',
            'subject_folder_name' => 'Week 3',
            'class_subject_id' => '2',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '9',
            'subject_folder_name' => 'Week 4',
            'class_subject_id' => '2',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '10',
            'subject_folder_name' => 'Week 5',
            'class_subject_id' => '2',
            'subject_folder_content' => null,
            'subject_subFolder' => 0
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '11',
            'subject_folder_name' => 'Chapter 1 Material',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => '1'
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '12',
            'subject_folder_name' => 'Chapter 1 Reading Materials',
            'class_subject_id' => '1',
            'subject_folder_content' => '<p>These are additional reading materials, please read it if you want a more in-depth understanding.</p>',
            'subject_subFolder' => '1'
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '13',
            'subject_folder_name' => 'Chapter 2 Material',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => '2'
        ]);

        DB::table('subject_folder_list')->insert([
            'subject_folder_id' => '14',
            'subject_folder_name' => 'Week 2 Reading Materials',
            'class_subject_id' => '1',
            'subject_folder_content' => null,
            'subject_subFolder' => '2'
        ]);
    }
}
