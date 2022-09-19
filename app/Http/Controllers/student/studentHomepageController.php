<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentHomepageController extends Controller
{
    public function studentHomepage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('student_subFolder', NULL)->where('active_status', 1)->orderBy('student_folder_id', 'ASC')->get();
            
            $notes = DB::table('student_note_list')->where('student_id', Session::get('username'))->where('student_note_subFolder', NULL)->where('active_status', 1)->orderBy('student_note_id', 'ASC')->get();
            
            $folders_dropdown = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->where('active_status', 1)->orderBy('student_folder_id', 'ASC')->get();

            return view('student/studentHomepage', compact('subjects', 'announcement', 'folders', 'folders_dropdown', 'notes'));
        }
    }

}
