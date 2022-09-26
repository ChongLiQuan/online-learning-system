<?php

namespace App\Http\Controllers\student;

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

            return view('student/studentSubmitAssignmentPage', compact('assignment'));
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

            return redirect('studentHomepage')->with('alert', 'Assignment Submitted Successfully.');
        }
    }
}
