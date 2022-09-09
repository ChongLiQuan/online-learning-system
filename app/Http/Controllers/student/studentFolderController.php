<?php


namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentFolderController extends Controller
{
    public function studentEditFolderView($student_folder_id)
    {
        $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
        $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
        $folder_edit = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->where('student_folder_id', $student_folder_id)->orderBy('student_folder_id', 'ASC')->get();
        $folders_dropdown = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->where('student_subFolder', '!=', $student_folder_id)->orWhere('student_subFolder', NULL)->orderBy('student_folder_id', 'ASC')->get();
        return view('student/studentEditFolder', compact('subjects', 'announcement', 'folder_edit', 'folders_dropdown'));
    }



    public function studentFolderContent($student_folder_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $current_student_folder_name = DB::table('student_note_folder_list')->where('student_folder_id', $student_folder_id)->where('student_name', Session::get('username'))->pluck('student_folder_name')->first();
            Session::put('current_student_folder_name', $current_student_folder_name);

            Session::put('current_student_folder_id', $student_folder_id);

            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->where('student_subFolder', $student_folder_id)->orderBy('student_folder_id', 'ASC')->get();
            $notes = DB::table('student_note_list')->where('student_name', Session::get('username'))->where('student_note_subFolder', $student_folder_id)->orderBy('student_note_id', 'ASC')->get();
            return view('student/studentFolderContent', compact('subjects', 'announcement', 'notes', 'folders'));
        }
    }


    public function addStudentFolder(Request $request)
    {
        $student_folder_name = $request->input('student_folder_name');
        $student_subFolder = $request->input('student_subFolder');
        $student_name = Session::get('username');

        if ($student_folder_name == NULL) {
            return redirect('studentHomepage')->with('error_folder_status', 'Please enter a folder name!');
        } else {
            DB::select('insert into student_note_folder_list (student_folder_name, student_name, student_subFolder) 
            values (?,?,?)', [$student_folder_name, $student_name, $student_subFolder]);

            return redirect('studentHomepage')->with('pass_folder_status', 'Folder Added Successfully.');
        }
    }

    public function editStudentFolder(Request $request)
    {
        $student_folder_name = $request->input('student_folder_name');
        $student_subFolder = $request->input('student_subFolder');

        $data = array(
            "student_folder_name" => $student_folder_name,
            "student_subFolder" => $student_subFolder,
        );

        //Check if same folder
        if ($student_folder_name == NULL) {
            return redirect('studentHomepage')->with('error_folder_status', 'Please enter a folder name!');
        } elseif ($student_subFolder == Session::get('current_student_folder_id')) {
            return redirect('studentHomepage')->with('error_folder_status', 'Cannot put existing folder as its sub-folder!');
        } else {
            DB::table('student_note_folder_list')->where('student_folder_id', Session::get('current_student_folder_id'))->update($data);


            return redirect('studentHomepage')->with('pass_folder_status', 'Folder Renamed Successfully.');
        }
    }

    public function deleteStudentFolder(Request $request)
    {
        $delete_id = $request->input('delete_id');

        DB::table('student_note_folder_list')->where('student_folder_id', [$delete_id])->delete();
        return back()->with('delete_status', 'Book Deleted Successfully! ');
    }
}
