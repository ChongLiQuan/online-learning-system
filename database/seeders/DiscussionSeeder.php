<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discussion_list')->insert([
            'discussion_id' => '1',
            'discussion_title' => 'Discuss the benefits of reading books',
            'discussion_content' => '<p>Please find out:</p><ol><li>Benefits of reading books</li><li>What is your favourite book of all time?</li></ol><p>Post it before our next Monday Class (8/9/2022) 2PM. We will review it together.&nbsp;</p>',
            'discussion_educator' => 'edu',
            'subject_folder_id' => '1',
            'discussion_student_subcomment' => '1',
            'discussion_student_edit' => '1',
            'created_at' => NOW(),
            'updated_at' => NULL,
        ]);


        DB::table('comment_list')->insert([
            'comment_id' => '1',
            'comment_title' => 'Student 1',
            'comment_content' => '<ol><li>Reading book helps us to improve our knowledge and widen our vision to explore the unknowns.&nbsp;</li><li>My all time favourite book is House of The Dragon. I like it because it is full of fantasy and mystery.&nbsp;</li></ol>',
            'discussion_id' => '1',
            'comment_username' => 'stu1',
            'sub_comment' => NULL,
            'created_at' => NOW(),
            'updated_at' => NULL,
        ]);

        DB::table('comment_list')->insert([
            'comment_id' => '2',
            'comment_title' => NULL,
            'comment_content' => '<p>Great Student 1. Thank you for sharing your experience. Would you recommend this book to your classmate?&nbsp;</p>',
            'discussion_id' => '1',
            'comment_username' => 'edu',
            'sub_comment' => '1',
            'created_at' => NOW(),
            'updated_at' => NULL,
        ]);

        DB::table('comment_list')->insert([
            'comment_id' => '3',
            'comment_title' => NULL,
            'comment_content' => '<p>Yes Miss, I highly recommend to suggest this book to those who enjoy fantasy stories.</p>',
            'discussion_id' => '1',
            'comment_username' => 'stu1',
            'sub_comment' => '1',
            'created_at' => NOW(),
            'updated_at' => NULL,
        ]);
    }
}
