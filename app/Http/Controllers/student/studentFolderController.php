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
        $announcement = DB::table('announcement_list')
            ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'announcement_list.class_subject_id')
            ->where('class_subject_list.class_name', Session::get('user_class'))
            ->orderBy('announcement_list.created_at', 'DESC')
            ->get();
        $folder_edit = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_folder_id', $student_folder_id)->orderBy('student_folder_id', 'ASC')->get();
        $folders_dropdown = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', '!=', $student_folder_id)->orWhere('student_subFolder', NULL)->where('active_status', 1)->orderBy('student_folder_id', 'ASC')->get();
        return view('student/studentEditFolder', compact('subjects', 'announcement', 'folder_edit', 'folders_dropdown'));
    }

    public function studentFolderContent($student_folder_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $current_student_folder_name = DB::table('student_note_folder_list')->where('student_folder_id', $student_folder_id)->where('student_id', Session::get('username'))->pluck('student_folder_name')->first();
            Session::put('current_student_folder_name', $current_student_folder_name);
            Session::put('current_student_folder_id', $student_folder_id);

            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')
                ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'announcement_list.class_subject_id')
                ->where('class_subject_list.class_name', Session::get('user_class'))
                ->orderBy('announcement_list.created_at', 'DESC')
                ->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('active_status', 1)->where('student_subFolder', $student_folder_id)->orderBy('student_folder_id', 'ASC')->get();
            $deleted_folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('active_status', 0)->where('student_subFolder', $student_folder_id)->orderBy('student_folder_id', 'ASC')->get();
            $notes = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('active_status', 1)->where('student_note_subFolder', $student_folder_id)->orderBy('student_note_id', 'ASC')->get();
            $deleted_notes = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('active_status', 0)->where('student_note_subFolder', $student_folder_id)->orderBy('student_note_id', 'ASC')->get();
            return view('student/studentFolderContent', compact('subjects', 'announcement', 'notes', 'folders', 'deleted_folders', 'deleted_notes'));
        }
    }


    public function addStudentFolder(Request $request)
    {
        $student_folder_name = $request->input('student_folder_name');
        $student_subFolder = $request->input('student_subFolder');
        $student_id = Session::get('username');

        if ($student_folder_name == NULL) {
            return redirect('studentHomepage')->with('error_folder_status', 'Please enter a folder name!');
        } else {
            DB::select('insert into student_note_folder_list (student_folder_name, student_id, student_subFolder, active_status, deleted_date) 
            values (?,?,?,?,?)', [$student_folder_name, $student_id, $student_subFolder, 1, NULL]);

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
        //Count Rows of Data
        $counter = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->get();
        $total = count($counter);

        //Update active status from folder database
        $current_date_time = \Carbon\Carbon::now()->addDay(30);
        DB::table('student_note_folder_list')->where('student_folder_id', [$delete_id])->update(['deleted_date' => $current_date_time, 'active_status' => 0]);

        //Update active status from folder database for subfolders

        for ($i = 0; $i <= $total; $i++) {
            //Get the recently deleted folder or sub-folder id and check if any folders is in it's sub-folder
            //Remove selected folder with the deleted subfolder
            DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$delete_id])->update(['deleted_date' => $current_date_time, 'active_status' => 0]);
            //Remove selected notes that is in the deleted folder
            DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_subFolder', [$delete_id])->update(['deleted_date' => $current_date_time, 'active_status' => 0, 'share_status' => 0]);

            $delete_id = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$delete_id])->pluck('student_folder_id')->first();
        }

        return redirect('studentHomepage')->with('pass_folder_status', 'Folder Has Been Moved to Recycler Bin, 30 days will be Deleted Permanently.');
    }

    public function permanentDeleteStudentFolder(Request $request)
    {
        $delete_id = $request->input('delete_id');

        //Deleted selected folder
        DB::table('student_note_folder_list')->where('student_folder_id', [$delete_id])->delete();

        return redirect('studentDeletedFolder')->with('pass_status', 'Folder Deleted Successfully.');
    }

    public function recoverStudentFolder(Request $request)
    {
        $recover_id = $request->input('recover_id');

        $folder_data = array(
            "deleted_date" => NULL,
            "active_status" => 1,
            "student_subFolder" => NULL,
        );

        $note_data = array(
            "deleted_date" => NULL,
            "active_status" => 1,
        );

        //Update Recovered Folder Data
        DB::table('student_note_folder_list')->where('student_folder_id', $recover_id)->update($folder_data);

        //Recover the entire folder content
        //Count Rows of Data
        $counter = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->get();
        $total = count($counter);

        //Update active status from folder database for subfolders, also recover the notes in the folders
        for ($i = 0; $i <= $total; $i++) {

            $recover_current_id = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$recover_id])->pluck('student_folder_id')->first();

            DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$recover_id])->update($folder_data);
            DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_subFolder', [$recover_id])->update($note_data);

            $recover_id = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$recover_current_id])->pluck('student_folder_id')->first();

            DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', [$recover_current_id])->update($folder_data);
            DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_subFolder', [$recover_current_id])->update($note_data);
        }

        return redirect('studentHomepage')->with('pass_folder_status', 'Folder Content Recovered Successfully.');
    }


    public function studentDeletedFolder()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('student_note_folder_list')->where('deleted_date', '<=', $current_date_time)->delete();

            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('active_status', 0)->orderBy('deleted_date', 'ASC')->get();
            $folders_dropdown = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            return view('student/studentDeletedFolder', compact('subjects', 'announcement', 'folders', 'folders_dropdown'));
        }
    }
}
