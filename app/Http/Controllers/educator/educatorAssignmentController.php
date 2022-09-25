<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class educatorAssignmentController extends Controller
{
    public function educatorAddAssignmentPage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
            $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
            return view('educator/educatorAddAssignmentPage', compact('list'));
        }
    }

    public function addAssignment (Request $request)
    {
        $assignment_title = $request->input('assignment_title');
        $assignment_due_date = $request->input('assignment_due_date');
        $assignment_full_mark = $request->input('assignment_full_mark');
        $assignment_folder = $request->input('assignment_folder');
        $assignment_content = $request->input('assignment_content');

        $data = array(
            "assignment_title" => $assignment_title,
            "assignment_due_date" => $assignment_due_date,
            "assignment_full_mark" => $assignment_full_mark,
            "subject_folder_id" => $assignment_folder,
            "assignment_content" => $assignment_content,
        );

        if ($assignment_title == NULL || $assignment_content == NULL) {
            return redirect('educatorAddAssignmentPage')->with('error_status', 'Please enter a assignment title or content cannot be empty!');
        } else {
            DB::table('assignment_list')->insert($data);

            return redirect('educatorAddAssignmentPage')->with('pass_status', 'Assignment Added Successfully.');
        }
    }
}
