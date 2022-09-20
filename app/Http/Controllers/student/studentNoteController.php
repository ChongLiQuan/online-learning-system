<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentNoteController extends Controller
{
    public function studentViewNote($student_note_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            Session::put('current_note_id', $student_note_id);

            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_id', $student_note_id)->get();
            return view('student/studentViewNote', compact('subjects', 'announcement', 'folders', 'note'));
        }
    }

    public function studentEditNoteView($student_note_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('active_status', 1)->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_id', $student_note_id)->get();
            return view('student/studentEditNote', compact('subjects', 'announcement', 'folders', 'note'));
        }
    }

    public function studentAddNote(Request $request)
    {
        $student_name = Session::get('username');
        $student_note_name = $request->input('student_note_name');
        $student_note_content = $request->input('student_note_content');
        $student_note_subject = $request->input('student_note_subject');
        $student_note_subFolder = $request->input('student_note_subFolder');
        $share_status = $request->input('share_status');

        if ($student_note_name == NULL) {
            return redirect('studentAddNote')->with('error_status', 'Please enter a note title!');
        }elseif( $student_note_subFolder == NULL){
            return redirect('studentAddNote')->with('error_status', 'Please select a folder!');
        } 
        else {
            DB::select('insert into student_note_list (student_id, student_note_name, student_note_content, student_note_subject_id, student_note_subFolder, share_status, educator_approval_status, active_status, deleted_date, student_class) 
            values (?,?,?,?,?,?,?,?,?,?)', [$student_name, $student_note_name, $student_note_content, $student_note_subject, $student_note_subFolder, $share_status, NULL, 1, NULL, Session::get('student_class')]);

            return redirect('studentAddNote')->with('pass_status', 'Note  Added Successfully.');
        }
    }

    public function studentEditNote(Request $request)
    {
        $student_note_id = $request->input('student_note_id');
        $student_note_name = $request->input('student_note_name');
        $student_note_content = $request->input('student_note_content');
        $student_note_subject_id = $request->input('student_note_subject');
        $student_note_subFolder = $request->input('student_note_subFolder');
        $share_status = $request->input('share_status');

        $data = array(
            "student_note_name" => $student_note_name,
            "student_note_content" => $student_note_content,
            "student_note_subject_id" => $student_note_subject_id,
            "student_note_subFolder" => $student_note_subFolder,
            "share_status" => $share_status,
        );

        if ($student_note_name == NULL) {
            return redirect('studentEditNoteView')->with('error_status', 'Please enter a note title!');
        }elseif( $student_note_subFolder == NULL){
            return redirect('studentEditNoteView')->with('error_status', 'Please select a folder!');
        } 
        else {
            DB::table('student_note_list')->where('student_note_id', $student_note_id)->update($data);

            if($share_status == 1){
                $stu_message = "Note " . $student_note_name . " has been requested for approval. Please wait for the educator to review it. Thank you."; 
                $stu_title = " Notes Share Request Status";
                $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

                DB::select('insert into notification_list (user_id, notification_title, notification_content, created_at, read_notification_status) 
                values (?,?,?,?,?)', [Session::get('username'), $stu_title, $stu_message, $current_date_time, 0]);

                //Find the note subject educator
                $edu_id = DB::table('class_subject_list')->where('class_subject_id', $student_note_subject_id)->pluck('educator_id')->first();

                $edu_message = "Note " . $student_note_name . " from student " . Session::get('user_full_name') . " has been requested for share approval with the class. ";  
                $edu_title = " New Notes Share Request Has Been Received";

                DB::select('insert into notification_list (user_id, notification_title, notification_content, created_at, read_notification_status) 
                values (?,?,?,?,?)', [$edu_id, $edu_title, $edu_message, $current_date_time, 0]);
            }

            return back()->with('pass_status', 'Note Added Successfully.');
        }
    }

    public function studentDeleteNote (Request $request)
    {
        $id = $request->input('delete_id');
        
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        DB::table('student_note_list')->where('student_note_id', [$id])->update(['deleted_date' => $current_date_time, 'active_status' => 0]);

        return redirect('studentHomepage')->with('pass_status', 'Note Has Been Moved to Recycler Bin, 30 days will be Deleted Permanently.');
    }

    public function studentDeletedNote()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $notes = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('active_status', 0)->orderBy('deleted_date', 'ASC')->get();
            $folders_dropdown = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            return view('student/studentDeletedNote', compact('subjects', 'announcement', 'notes', 'folders_dropdown'));
        }
    }

    public function studentPermanentDeletedNote(Request $request)
    {
        $delete_id = $request->input('delete_id');

        //Deleted selected folder
        DB::table('student_note_list')->where('student_note_id', [$delete_id])->delete();

        return redirect('studentDeletedNote')->with('pass_status', 'Note Deleted Successfully.');
    }

    public function recoverStudentNote(Request $request)
    {
        $recover_id = $request->input('recover_id');

        $note_data = array(
            "student_note_subFolder" => NULL,
            "deleted_date" => NULL,
            "active_status" => 1,
        );

        //Update Recovered Folder Data
        DB::table('student_note_list')->where('student_note_id', $recover_id)->update($note_data);

        return redirect('studentHomepage')->with('pass_folder_status', 'Notes Content Recovered Successfully.');
    }
}
