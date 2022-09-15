<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class educatorContentController extends Controller
{
    public function addContent(Request $request)
    {
        $content_title = $request->input('content_title');
        $subject_folder_id = $request->input('subject_folder_id');
        $content = $request->input('content');


        if ($content_title == NULL || $subject_folder_id == NULL) {
            return redirect('educatorAddContent')->with('error_status', 'Please enter a content title or select a sub-folder!');
        } else {
            DB::select('insert into folder_content_list (folder_content_title, subject_folder_content, subject_folder_id) 
            values (?,?,?)', [$content_title, $content, $subject_folder_id]);

            return redirect('educatorAddContent')->with('pass_status', 'Content Added Successfully.');
        }
    }

    public function editContent(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $content_title = $request->input('content_title');
        $subject_folder_id = $request->input('subject_folder_id');
        $content = $request->input('content');

        $data = array(
            "folder_content_title" => $content_title,
            "subject_folder_content" => $content,
            "subject_folder_id" => $subject_folder_id,
        );

        if ($content_title == NULL || $subject_folder_id == NULL) {
            return redirect('educatorAddContent')->with('error_status', 'Please enter a content title or select a sub-folder!');
        } else {
            DB::table('folder_content_list')->where('folder_content_id', $edit_id)->update($data);

            return back()->with('pass_status', 'Content Edited Successfully.');
        }
    }

    public function deleteContent(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('folder_content_list')->where('folder_content_id', [$id])->delete();
        return back()->with('delete_status', 'Content Deleted Successfully! ');
    }

    public function educatorViewNote($student_note_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('username');
            $subjects = DB::table('class_subject_list')->where('educator_id', $username)->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('annouce_id', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            $note = DB::table('student_note_list')->where('student_note_id', $student_note_id)->get();
            return view('educator/educatorViewNote', compact('subjects', 'announcement', 'folders', 'note'));
        }
    }

    public function approveStudentNote(Request $request)
    {
        $edit_id = $request->input('delete_id');

        DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_approval_status' => 1]);

        return redirect('educatorHomepage')->with('pass_status', 'Note Approved Successfully.');
    }

    public function rejectStudentNote(Request $request)
    {
        $edit_id = $request->input('delete_id');

        DB::table('student_note_list')->where('student_note_id', $edit_id)->update(['educator_approval_status' => 0]);

        return redirect('educatorHomepage')->with('pass_status', 'Note Rejected Successfully.');
    }
}
