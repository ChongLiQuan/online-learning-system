<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('announcement_list')->insert([
            'annouce_title' => 'Welcome to the Kelas 1 Ariff 2022!',
            'class_subject_id' => '1',
            'annouce_content' => '<p>
            Dear Kelas,
            <br>
             
            </p>
            <p>
            Today is the first week of our class. Please be prepared for the study materials. 
            </p>
            <figure class="table"><table border=1><colgroup><col style="width:50%;"><col style="width:50%;"></colgroup><tbody><tr><td>One word file of your self introduction&nbsp;</td><td>5 Marks&nbsp;</td></tr><tr><td>One powerpoint slides of your background&nbsp;</td><td>5 Marks&nbsp;</td></tr></tbody></table></figure>
            <p>
             
            </p>
            <p>
            Yours Sincerely,
            <br>
            Chong Li Quan 
            </p>',
            'annouce_educator' => 'Shawn Tan Cheng',
            'created_at' => NOW(),
        ]);

        DB::table('announcement_list')->insert([
            'annouce_title' => 'First Class Activity for 1 Ariff!',
            'class_subject_id' => '1',
            'annouce_content' => '<p>Dear Student,&nbsp;</p><p>Please remember that the assignment below must be answered before our next <mark class="marker-yellow">Monday class at 3/9/2022 10:00AM.</mark></p><figure class="table"><table border=1><colgroup><col style="width:76.19%;"><col style="width:23.81%;"></colgroup><tbody><tr><td><strong>What is the longest River in Malaysia?</strong></td><td>5 Marks&nbsp;</td></tr><tr><td><strong>When was Malaysia became independent?</strong></td><td>10 Marks&nbsp;</td></tr></tbody></table></figure><p><a href="https://www.google.com/search?q=links+for+river&amp;rlz=1C5CHFA_enMY997MY997&amp;oq=links+for+river+&amp;aqs=chrome..69i57l2j0i271l3j69i65j69i60l2.1767j0j7&amp;sourceid=chrome&amp;ie=UTF-8">https://www.google.com/search?q=links+for+river&amp;rlz=1C5CHFA_enMY997MY997&amp;oq=links+for+river+&amp;aqs=chrome..69i57l2j0i271l3j69i65j69i60l2.1767j0j7&amp;sourceid=chrome&amp;ie=UTF-8</a></p><p>Best Regards,<br>Ms. Usha</p>',
            'annouce_educator' => 'Shawn Tan Cheng',
            'created_at' => NOW(),
        ]);

        DB::table('announcement_list')->insert([
            'annouce_title' => 'Please take note on this matter.',
            'class_subject_id' => '4',
            'annouce_content' => '<p><p>Dear Student,</p><p>&nbsp;</p><p>It has came to my concern that many of you has been sending me email regarding the latest assignment.</p><p>&nbsp;</p><p><span style="background-color:hsl(30, 75%, 60%);"><strong><u>Here are some stuff that I want to clarify:</u></strong></span></p><ol><li><strong>Please do not </strong>use wikipedia as your source of information.<br>&nbsp;</li><li><strong>Do not use the same point</strong> as your friends.<br>&nbsp;</li><li>Please<strong> submit it on this Friday </strong>thru the submission link.</li></ol><p>Best Regards,<br>Ms Unidi&nbsp;</p></p>',
            'annouce_educator' => 'Kelly Khoo Shin',
            'created_at' => NOW(),
        ]);


        DB::table('announcement_list')->insert([
            'annouce_title' => 'Homework Reminder: Poem Research.',
            'class_subject_id' => '4',
            'annouce_content' => '<p>Hi Student,</p><p>Please prepare the following for our <span style="background-color:hsl(180, 75%, 60%);">upcoming class next Monday 11:00AM - 3:00PM.</span></p><p>&nbsp;</p><ul><li>Self-introduction within 100 words.</li><li>Research on the Poem: Words of Flowers, Thorns like a bee.</li><li>Prepare a summary of the poem within 200 words in a group of 2 people.<br>&nbsp;</li></ul><p>Yours Sincerely,<br>Mr. Edmund&nbsp;</p>',
            'annouce_educator' => 'Kelly Khoo Shin',
            'created_at' => NOW(),
        ]);

        //For the announcement status 

        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20221',
            'annouce_id' => '1',
            'annouce_status' => '0',
        ]);

        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20222',
            'annouce_id' => '1',
            'annouce_status' => '0',
        ]);


        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20221',
            'annouce_id' => '2',
            'annouce_status' => '0',
        ]);

        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20222',
            'annouce_id' => '2',
            'annouce_status' => '0',
        ]);

        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20223',
            'annouce_id' => '3',
            'annouce_status' => '0',
        ]);

        DB::table('announcement_status')->insert([
            'student_id' => 'STU_20223',
            'annouce_id' => '4',
            'annouce_status' => '0',
        ]);
    }
}
