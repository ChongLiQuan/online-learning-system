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
            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_name', Session::get('username'))->where('student_note_id', $student_note_id)->get();
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
            $folders = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_name', Session::get('username'))->where('student_note_id', $student_note_id)->get();
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
            DB::select('insert into student_note_list (student_name, student_note_name, student_note_content, student_note_subject, student_note_subFolder, share_status, educator_approval_status) 
            values (?,?,?,?,?,?,?)', [$student_name, $student_note_name, $student_note_content, $student_note_subject, $student_note_subFolder, $share_status, 0]);

            return redirect('studentAddNote')->with('pass_status', 'Note  Added Successfully.');
        }
    }

    public function studentEditNote(Request $request)
    {
        $student_note_id = $request->input('student_note_id');
        $student_note_name = $request->input('student_note_name');
        $student_note_content = $request->input('student_note_content');
        $student_note_subject = $request->input('student_note_subject');
        $student_note_subFolder = $request->input('student_note_subFolder');
        $share_status = $request->input('share_status');

        $data = array(
            "student_note_name" => $student_note_name,
            "student_note_content" => $student_note_content,
            "student_note_subject" => $student_note_subject,
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

            return back()->with('pass_status', 'Note Added Successfully.');
        }
    }

    public function studentDeleteNote (Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('student_note_list')->where('student_note_id', [$id])->delete();
        return redirect('studentHomepage')->with('pass_status', 'Note Deleted Successfully! ');
    }
}
