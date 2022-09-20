<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class educatorDiscussionController extends Controller
{
    public function addDiscussion(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $discussion_title = $request->input('discussion_title');
        $subject_folder_id = $request->input('subject_folder_id');
        $discussion_content = $request->input('discussion_content');
        $discussion_educator = $request->input('discussion_educator');
        $student_reply = $request->input('student_reply');
        $student_edit = $request->input('student_edit');
        $discussion_date = $current_date_time;

        if ($discussion_title == NULL || $subject_folder_id == NULL) {
            return redirect('educatorAddDiscussion')->with('error_status', 'Please enter a discussion title or a sub-folder!');
        } else {
            DB::select('insert into discussion_list (discussion_title, discussion_content, discussion_educator, subject_folder_id, created_at, discussion_student_subcomment, discussion_student_edit) 
            values (?,?,?,?,?,?,?)', [$discussion_title, $discussion_content, $discussion_educator, $subject_folder_id, $discussion_date, $student_reply, $student_edit]);

            $subject_id = DB::table('subject_folder_list')->where('subject_folder_id', $subject_folder_id)->pluck('class_subject_id')->first();
            $class_name = DB::table('class_subject_list')->where('class_subject_id', $subject_id)->pluck('class_name')->first();
            $subject_code =  DB::table('class_subject_list')->where('class_subject_id', $subject_id)->pluck('subject_code')->first();
            $subject_name = DB::table('subject_list')->where('subject_code', $subject_code)->pluck('subject_name')->first();

            $count = DB::table('student_list')->select('student_id')->where('student_class', $class_name)->get();

            //Add each student and status for this current announcement
            foreach ($count as $c) {
                $dataSet[] = [
                    'user_id'  => $c->student_id,
                    'notification_title' => " New Discussion Available",
                    'notification_content' => "New Discussion (" . $discussion_title . ") Available for " . $subject_name . " .",
                    'created_at' => $discussion_date,
                    'read_notification_status' => 0,
                ];
            }
            DB::table('notification_list')->insert($dataSet);

            return redirect('educatorAddDiscussion')->with('pass_status', 'Discussion Added Successfully.');
        }
    }

    public function editDiscussion(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $discussion_title = $request->input('discussion_title');
        $subject_folder_id = $request->input('subject_folder_id');
        $discussion_content = $request->input('discussion_content');
        $student_reply = $request->input('student_reply');
        $student_edit = $request->input('student_edit');

        $data = array(
            "discussion_title" => $discussion_title,
            "discussion_content" => $discussion_content,
            "subject_folder_id" => $subject_folder_id,
            "discussion_student_subcomment" => $student_reply,
            "discussion_student_edit" => $student_edit,

        );

        if ($discussion_title == NULL || $subject_folder_id == NULL) {
            return redirect('educatorEditDiscussion')->with('error_status', 'Please enter a discussion title or select a sub-folder!');
        } else {
            DB::table('discussion_list')->where('discussion_id', $edit_id)->update($data);

            return back()->with('pass_status', 'Discussion Information Edited Successfully.');
        }
    }

    public function deleteDiscussion(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('discussion_list')->where('discussion_id', [$id])->delete();
        return back()->with('delete_status', 'Discussion Deleted Successfully! ');
    }
}
