<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folder_content_list')->insert([
            'content_id' => '1',
            'content_title' => 'Nouns or Proper Nouns',
            'content' => '<p><span style="background-color:hsl(180, 75%, 60%);"><strong>Common nouns and proper nouns.</strong></span></p><p><strong>Common nouns:</strong></p><ul><li>A word that refers to an object or a thing but not the name of a particular person or place.</li><li>Example: duck, car, food</li></ul><p><strong>Proper nouns:</strong></p><ul><li>Name of a particular person, place, or thing.</li><li>Example: Robin Hood, Jalan Emas</li></ul><figure class="image image_resized" style="width:75%;" data-ckbox-resource-id="_eU1oR_Sn-yl"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/103.webp 103w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/206.webp 206w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/309.webp 309w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/412.webp 412w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/515.webp 515w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/618.webp 618w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/721.webp 721w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/824.webp 824w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/927.webp 927w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/1030.webp 1030w" sizes="(max-width: 1030px) 100vw, 1030px" type="image/webp"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/_eU1oR_Sn-yl/images/1030.png" alt=""></picture></figure>',
            'folder_id'=> '12',
        ]);

        DB::table('folder_content_list')->insert([
            'content_id' => '2',
            'content_title' => 'English Form 1 Textbook',
            'content' => '<p>We will be using the English Form 1 Textbook for this syllabus. Attached is the textbook cover and textbook soft-copy link. Please download it as we will be using it as our main source of resources.&nbsp;</p><figure class="image image_resized" style="width:50%;" data-ckbox-resource-id="2A2IYAHncrSd"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/96.webp 96w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/186.webp 186w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/276.webp 276w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/366.webp 366w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/456.webp 456w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/546.webp 546w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/636.webp 636w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/726.webp 726w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/816.webp 816w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/906.webp 906w" sizes="(max-width: 906px) 100vw, 906px" type="image/webp"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/2A2IYAHncrSd/images/906.png" alt=""></picture></figure><p><span style="background-color:hsl(150, 75%, 60%);"><strong><u>Soft-copy of English Form 1 Textbook:</u></strong></span></p><p><mark class="marker-yellow">Link</mark>: <a href="http://anyflip.com/fmqhk/blsk">http://anyflip.com/fmqhk/blsk</a></p><p><mark class="marker-yellow">Textbook PDF</mark>: <a href="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/-RSQiM9Vfdaz/file?download=true" data-ckbox-resource-id="-RSQiM9Vfdaz">Exmaple Assignment</a></p>',
            'folder_id'=> '11',
        ]);

        DB::table('folder_content_list')->insert([
            'content_id' => '3',
            'content_title' => 'Simple Present Tense and Nouns',
            'content' => '<p><strong><u>A Simple Present Tense:</u></strong></p><figure class="table"><table style="border-color:hsl(180, 75%, 60%);border-style:solid;"><colgroup><col style="width:34.57%;"><col style="width:65.43%;"></colgroup><tbody><tr><td><p style="text-align:center;"><span style="background-color:hsl(180, 75%, 60%);"><strong>The Simple Present Use For</strong></span></p></td><td><p style="text-align:center;"><span style="background-color:hsl(180, 75%, 60%);"><strong>Examples</strong></span></p></td></tr><tr><td>Daily Routines&nbsp;</td><td><ul><li>John <strong>starts</strong> work at 6 oclock every morning.</li><li>They <strong>start</strong> work at 6 oclock every morning.</li></ul></td></tr><tr><td>Timetables, Programmers</td><td><ul><li>The counseling session <strong>begins</strong> at 9 a.m daily.</li></ul></td></tr><tr><td>Universal Truths</td><td><ul><li>The Earth <strong>revolves</strong> around the sun.</li></ul></td></tr></tbody></table></figure><p>Please use the tree map to help you organize your information. Example, Could you please tell me when the reunion will be held? May I Know what time the event will start?&nbsp;</p><p>&nbsp;</p><p><strong><u>Short and Long Vowel Sounds:</u></strong></p><p>Say these words aloud. Your class has created a few online quizzes. You have set up stations at the Computer Laboratory to test weather the quizzes are workable.</p><p>&nbsp;</p>',
            'folder_id'=> '12',
        ]);

        DB::table('folder_content_list')->insert([
            'content_id' => '4',
            'content_title' => 'Recap on Adjectives',
            'content' => '<p><span style="background-color:hsl(60, 75%, 60%);"><i><strong>Adjectives:</strong></i></span></p><ul><li>You can form negative adjectives by adding prefixes such as <strong>dis</strong>-, <strong>un</strong>- <strong>im</strong>- before the adjectives.</li></ul><figure class="image image_resized" style="width:75%;" data-ckbox-resource-id="KycKC0p-JnAZ"><picture><source srcset="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/85.webp 85w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/170.webp 170w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/255.webp 255w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/340.webp 340w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/425.webp 425w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/510.webp 510w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/595.webp 595w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/680.webp 680w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/765.webp 765w,https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/850.webp 850w" sizes="(max-width: 850px) 100vw, 850px" type="image/webp"><img src="https://ckbox.cloud/Lw28ikPlkel3fsSIx5lU/assets/KycKC0p-JnAZ/images/850.png" alt=""></picture></figure><p><mark class="marker-yellow">Comparative adjectives </mark>are used to compare two nouns or pronouns.</p><ul><li>You must add and <strong>than</strong> to the adjective when comparing two objects.</li><li><strong>Note</strong>: When <strong>comparing two objects</strong>, the word <strong>than</strong> must <strong>follow</strong> after the comparative adjective.</li></ul><ol><li>This bag is <strong>lighter</strong> than that one.</li><li>Her hair is <strong>thicker</strong> than Amys.</li></ol>',
            'folder_id'=> '1',
        ]);

    }
}
