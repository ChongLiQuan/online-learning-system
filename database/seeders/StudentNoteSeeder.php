<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class StudentNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date_time = Carbon::now()->toDateTimeString();

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '1',
            'student_folder_name' => 'Self Journal',
            'student_id' => 'STU_20221',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '2',
            'student_folder_name' => 'To-Do-List',
            'student_id' => 'STU_20221',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '3',
            'student_folder_name' => 'English',
            'student_id' => 'STU_20221',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '4',
            'student_folder_name' => 'Bahasa Melayu',
            'student_id' => 'STU_20221',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '5',
            'student_folder_name' => 'Sejarah',
            'student_id' => 'STU_20221',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '6',
            'student_folder_name' => 'September 2022',
            'student_id' => 'STU_20221',
            'student_subFolder' => '2',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '7',
            'student_folder_name' => 'October 2022',
            'student_id' => 'STU_20221',
            'student_subFolder' => '2',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '8',
            'student_folder_name' => 'November 2022',
            'student_id' => 'STU_20221',
            'student_subFolder' => '2',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);


        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '9',
            'student_folder_name' => 'Chapter 1: Poem',
            'student_id' => 'STU_20221',
            'student_subFolder' => '3',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '10',
            'student_folder_name' => 'Chapter 2: Past Tense',
            'student_id' => 'STU_20221',
            'student_subFolder' => '3',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_name' => 'BM',
            'student_id' => 'STU_20223',
            'student_subFolder' => NULL,
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        /*
        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '10',
            'student_folder_name' => 'Example 2',
            'student_name' => 'stu1',
            'student_subFolder' => NULL,
            'deleted_date' => '2022-11-13 19:44:27',
            'active_status' => '0',
        ]);

        DB::table('student_note_folder_list')->insert([
            'student_folder_id' => '11',
            'student_folder_name' => 'Example 3',
            'student_name' => 'stu1',
            'student_subFolder' => NULL,
            'deleted_date' => \Carbon\Carbon::now()->toDateTimeString(),
            'active_status' => '0',
        ]);
        */

        /** Student Notes Content Seeder */
        DB::table('student_note_list')->insert([
            'student_note_id' => '1',
            'student_id' => 'STU_20221',
            'student_note_name' => 'Reminders',
            'student_note_content' => '<p><span style="background-color:hsl(90, 75%, 60%);">Dear self,</span></p><ul><li>Please keep a positive attitude when facing problem.</li><li>Seek for external self if I really cant handle it, we are all just humans.</li></ul><figure class="image image_resized" style="width:23.6%;" data-ckbox-resource-id="D2iYNuvhV0PH"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/146.webp 146w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/226.webp 226w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/306.webp 306w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/386.webp 386w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/466.webp 466w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/546.webp 546w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/626.webp 626w" sizes="(max-width: 626px) 100vw, 626px" type="image/webp"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/D2iYNuvhV0PH/images/626.jpeg" alt=""></picture></figure><p><span style="background-color:hsl(60, 75%, 60%);">Dont forget to drink plenty of water and stay hydrated.</span></p>',
            'student_note_subject_id' => NULL,
            'student_note_subFolder' => '1',
            'share_status' => '0',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_note_id' => '2',
            'student_id' => 'STU_20221',
            'student_note_name' => 'Timetable',
            'student_note_content' => '<p><span style="background-color:hsl(180,75%,60%);">Timetable for this year Class of 1 Ariff:</span></p><figure class="image image_resized" style="width:50%;" data-ckbox-resource-id="ftZMLxI8_PSE"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/192.webp 192w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/384.webp 384w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/576.webp 576w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/768.webp 768w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/960.webp 960w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1152.webp 1152w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1344.webp 1344w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1536.webp 1536w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1728.webp 1728w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1920.webp 1920w" type="image/webp" sizes="(max-width: 1920px) 50vw, 1920px"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/ftZMLxI8_PSE/images/1920.webp" alt=""></picture></figure>',
            'student_note_subject_id' => NULL,
            'student_note_subFolder' => '1',
            'share_status' => '0',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_note_id' => '3',
            'student_id' => 'STU_20221',
            'student_note_name' => 'Poem Note',
            'student_note_content' => '<p><mark class="marker-green">Tips on getting full marks:</mark></p><ol><li><mark class="marker-yellow">Big and small letter must be consistent.&nbsp;</mark></li><li><mark class="marker-yellow">Remember to leave 2 gaps between each lines</mark></li><li><mark class="marker-yellow">Do not use I, You, We, They etc???&nbsp;</mark></li></ol><p>&nbsp;</p><figure class="image image_resized" style="width:50%;" data-ckbox-resource-id="z3PZky-f3Pl2"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/115.webp 115w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/195.webp 195w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/275.webp 275w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/355.webp 355w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/435.webp 435w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/515.webp 515w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/595.webp 595w" sizes="(max-width: 595px) 100vw, 595px" type="image/webp"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/z3PZky-f3Pl2/images/595.png" alt=""></picture></figure>',
            'student_note_subject_id' => '1',
            'student_note_subFolder' => '9',
            'share_status' => '0',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_note_id' => '4',
            'student_id' => 'STU_20221',
            'student_note_name' => 'Past Tense Note',
            'student_note_content' => '<p><strong><u>Past Tense:</u></strong></p><p>We need to watch out what the sentence is trying to describe.&nbsp;&nbsp;&nbsp;<br><mark class="marker-yellow">Grammar is very important as mark will be deducted if grammar error is founded in the exam paper.&nbsp;</mark></p><p>&nbsp;</p><figure class="image image_resized" style="width:50%;" data-ckbox-resource-id="01I_qyssxm1h"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/205.webp 205w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/403.webp 403w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/601.webp 601w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/799.webp 799w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/997.webp 997w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1195.webp 1195w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1393.webp 1393w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1591.webp 1591w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1789.webp 1789w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1987.webp 1987w" type="image/webp" sizes="(max-width: 1987px) 40vw, 1987px"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/01I_qyssxm1h/images/1987.png" alt=""></picture></figure>',
            'student_note_subject_id' => '1',
            'student_note_subFolder' => '10',
            'share_status' => '1',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_id' => 'STU_20221',
            'student_note_name' => 'Past Tense Note: Part 2',
            'student_note_content' => '<p>This is Testing</p>',
            'student_note_subject_id' => '1',
            'student_note_subFolder' => '10',
            'share_status' => '1',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);


        DB::table('student_note_list')->insert([
            'student_id' => 'STU_20221',
            'student_note_name' => 'Ariff BM Note',
            'student_note_content' => '<p>This is Testing</p>',
            'student_note_subject_id' => '2',
            'student_note_subFolder' => '4',
            'share_status' => '1',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Ariff',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_id' => 'STU_20223',
            'student_note_name' => 'Eng Bestari Note: Part 1',
            'student_note_content' => '<p>This is Testing</p>',
            'student_note_subject_id' => '3',
            'student_note_subFolder' => '11',
            'share_status' => '1',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Bestari',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);

        DB::table('student_note_list')->insert([
            'student_id' => 'STU_20223',
            'student_note_name' => 'Eng Bestari Note: Part 2',
            'student_note_content' => '<p>This is Testing</p>',
            'student_note_subject_id' => '3',
            'student_note_subFolder' => '11',
            'share_status' => '1',
            'share_date' => $current_date_time,
            'educator_approval_status' => NULL,
            'student_class' => '1 Bestari',
            'deleted_date' => NULL,
            'active_status' => '1',
        ]);
    }
}
