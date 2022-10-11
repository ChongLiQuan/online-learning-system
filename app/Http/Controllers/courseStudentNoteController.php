<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class courseStudentNoteController extends Controller
{
    public function courseStudentNotePage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $subjects = DB::table('class_subject_list')->where('class_subject_id', Session::get('current_subject_id'))->get('subject_code');
            $note = DB::table('student_note_list')
                ->where('student_note_subject_id', Session::get('current_subject_id'))
                ->where('educator_approval_status', 1)
                ->where('active_status', 1)
                ->orderBy('student_note_id')->get();

            return view('/courseStudentNotePage', compact('subjects', 'note'));
        }
    }

    public function educatorReviewNotePage($student_note_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('user_full_name');
            $subjects = DB::table('class_subject_list')->where('educator_id', Session::get('username'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('annouce_id', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_note_id', $student_note_id)->get();
            return view('educator/educatorReviewNotePage', compact('subjects', 'announcement', 'folders', 'note'));
        }
    }

    public function courseDisplayStudentNoteContentPage($student_note_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('user_full_name');
            $announcement = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('annouce_id', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_note_id', $student_note_id)->get();
            return view('courseDisplayStudentNotePage', compact('announcement', 'folders', 'note'));
        }
    }

    public function educatorUnshareNote(Request $request)
    {
        $note_id = $request->input('note_id');

        DB::table('student_note_list')->where('student_note_id', $note_id)->update(['educator_approval_status' => 0, 'share_status' => 0]);
        $student_id = DB::table('student_note_list')->where('student_note_id', $note_id)->pluck('student_id')->first();
        $note_name = DB::table('student_note_list')->where('student_note_id', $note_id)->pluck('student_note_name')->first();
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        //Email to student notify of cancelling share status by the educator
        $stu_msg = "Note " . $note_name . " unfortunately has been unshared by the educator. Your note will not be share with the coursemate. Tips: Try to make changes according to the educator comment. Thank you.";
        $stu_title = " Notes Share Request Has Been Unshare! ";

        //Add Educator Comment if there is any
        DB::select('insert into notification_list (user_id, notification_title, notification_content, created_at, read_notification_status) 
        values (?,?,?,?,?)', [$student_id, $stu_title, $stu_msg, $current_date_time, 0]);

        return $this->courseStudentNotePage()->with('alert', 'Note Unshared Successfully.');
    }

    public function reviewStudentNote(Request $request)
    {
        $edit_id = $request->input('delete_id');
        $submit = $request->input('submit');
        $comment = $request->input('comment');
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        //Educator choose to approve note
        if ($submit == 1) {

            DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_approval_status' => 1]);
            $student_id = DB::table('student_note_list')->where('student_note_id', $edit_id)->pluck('student_id')->first();
            $note_name = DB::table('student_note_list')->where('student_note_id', $edit_id)->pluck('student_note_name')->first();

            $stu_msg = "Note " . $note_name . " has been approved by the educator successfully. Your note will now be available to view by the coursemate. Thank you for sharing.";
            $stu_title = " Notes Share Request Has Been Approved! ";

            //Add Educator Comment if there is any
            if ($comment != NULL) {
                $stu_msg = $stu_msg . " <br> Educator Comment:  " . $comment;
                DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_comment' => $comment]);
            }
            DB::select('insert into notification_list (user_id, notification_title, notification_content, created_at, read_notification_status) 
            values (?,?,?,?,?)', [$student_id, $stu_title, $stu_msg, $current_date_time, 0]);

            return redirect('educatorHomepage')->with('pass_status', 'Note Approved Successfully.');
        } elseif ($submit == 0) { //Educator choose to reject note

            DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_approval_status' => 0, 'share_status' => 0]);
            $student_id = DB::table('student_note_list')->where('student_note_id', $edit_id)->pluck('student_id')->first();
            $note_name = DB::table('student_note_list')->where('student_note_id', $edit_id)->pluck('student_note_name')->first();

            $stu_msg = "Note " . $note_name . " unfortunately has been rejected by the educator. Your note will not be share with the coursemate. Tips: Try to make changes according to the educator comment. Thank you.";
            $stu_title = " Notes Share Request Has Been Rejected! ";

            //Add Educator Comment if there is any
            if ($comment != NULL) {
                $stu_msg = $stu_msg . " <br><b> Educator Comment: </b> " . $comment;
                DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_comment' => $comment]);
            }
            DB::select('insert into notification_list (user_id, notification_title, notification_content, created_at, read_notification_status) 
            values (?,?,?,?,?)', [$student_id, $stu_title, $stu_msg, $current_date_time, 0]);

            return redirect('educatorHomepage')->with('pass_status', 'Note Rejected Successfully.');
        }
    }
}
