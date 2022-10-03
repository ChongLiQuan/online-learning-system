<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentResultController extends Controller
{
    public function studentResultPage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            //Fetch all assignment that belong to student class
            $allAssignment = DB::table('assignment_submission_list')
                ->join('assignment_list', 'assignment_list.assignment_id', '=', 'assignment_submission_list.assignment_id')
                ->where('assignment_submission_list.student_id', Session::get('username'))
                ->orderBy('assignment_submission_list.submission_id', 'asc')
                ->get();

                $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();

            return view('student/studentResultPage', compact('allAssignment', 'subjects'));
        }
    }
}
