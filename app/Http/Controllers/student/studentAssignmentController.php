<?php

namespace App\Http\Controllers\student;

use Mail;
use App\Mail\assignmentSubmissionMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentAssignmentController extends Controller
{
    public function studentSubmitAssignmentPage($assignment_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $assignment = DB::table('assignment_list')->where('assignment_id', $assignment_id)->get();

            //To set the session value
            $assignment_folder =  DB::table('assignment_list')->where('assignment_id', $assignment_id)->pluck('subject_folder_id')->first();

            $subject_code =
                DB::table('class_subject_list')
                ->join('subject_folder_list', 'subject_folder_list.class_subject_id', '=', 'class_subject_list.class_subject_id')
                ->where('subject_folder_list.subject_folder_id', $assignment_folder)
                ->pluck('class_subject_list.subject_code')
                ->first();

            $course_name = DB::table('subject_list')->where('subject_code', $subject_code)->pluck('subject_name')->first();
            Session::put('current_subject_code', $subject_code);
            Session::put('current_course_name', $course_name);

            return view('student/studentSubmitAssignmentPage', compact('assignment'));
        }
    }

    public function studentViewOwnSubmissionPage($assignment_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $assignment = DB::table('assignment_list')->where('assignment_id', $assignment_id)->get();
            $submissions = DB::table('assignment_submission_list')->where('assignment_id', $assignment_id)->where('student_id', Session::get('username'))->get();

            return view('student/studentViewOwnSubmissionPage', compact('submissions', 'assignment'));
        }
    }

    public function submitAssignment(Request $request)
    {
        $student_id = Session::get('username');
        $assignment_id = $request->input('assignment_id');
        $assignment_content = $request->input('assignment_content');
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        if ($assignment_content == NULL) {
            return redirect('studentSubmitAssignmentPage')->with('error_folder_status', 'Assignment Content Cannot be Empty!');
        } else {
            DB::select('insert into assignment_submission_list (student_id, assignment_id, submission_content, submission_date) 
            values (?,?,?,?)', [$student_id, $assignment_id, $assignment_content, $current_date_time]);

            //Fetch the specific assignment email status
            $status = DB::table('assignment_list')->where('assignment_id', $assignment_id)->pluck('assignment_email_educator_status')->first();

            //Validate the email status
            if ($status == 1) {
                $this->sendMail($student_id, $assignment_id);
            }

            return redirect()->route('studentViewOwnSubmissionPage', $assignment_id)->with('alert', 'Assignment Submitted Successfully.');
        }
    }

    public function sendMail($student_id, $assignment_id)
    {        
        Mail::to('liquan_max@hotmail.com')->send(new assignmentSubmissionMail($student_id, $assignment_id));

        return view('student/studentHomepage');
    }
}
