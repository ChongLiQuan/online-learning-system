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
            $folders = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->where('student_subFolder', NULL)->orderBy('student_folder_id', 'ASC')->get();
            $folders_dropdown = DB::table('student_note_folder_list')->where('student_name', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();
            return view('student/studentHomepage', compact('subjects', 'announcement', 'folders', 'folders_dropdown'));
        }
    }

}
