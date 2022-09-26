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

    public function educatorEditAssignmentPage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
            $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();

            return view('educator/educatorEditAssignmentPage', compact('list'));
        }
    }

    public function addAssignment(Request $request)
    {
        $assignment_title = $request->input('assignment_title');
        $assignment_due_date = $request->input('assignment_due_date');
        $assignment_full_mark = $request->input('assignment_full_mark');
        $assignment_folder = $request->input('assignment_folder');
        $assignment_content = $request->input('assignment_content');

        $assignment_data = array(
            "assignment_title" => $assignment_title,
            "assignment_due_date" => $assignment_due_date,
            "assignment_full_mark" => $assignment_full_mark,
            "subject_folder_id" => $assignment_folder,
            "assignment_content" => $assignment_content,
        );

        if ($assignment_title == NULL || $assignment_content == NULL) {
            return redirect('educatorAddAssignmentPage')->with('error_status', 'Please enter a assignment title or content cannot be empty!');
        } else {
            DB::table('assignment_list')->insert($assignment_data);
            //Fetch the student name from the student list that are in this notification class
            $count = DB::table('student_list')->select('student_id')->where('student_class', Session::get('current_class_name'))->get();

            //Notify the course student
            $title = " New Assignment for Course: " . Session::get('current_subject_code');
            $msg = "New Assignment: " . $assignment_title . " has been added in class content. The due date is on: " . $assignment_due_date . ". Please submit it before the due date. Thank you.";
            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

            //Add each student and status for this current notification
            foreach ($count as $c) {
                $dataSet[] = [
                    'user_id'  => $c->student_id,
                    'notification_title'    => $title,
                    'notification_content'       => $msg,
                    'created_at'    => $current_date_time,
                    'read_notification_status'       => 0,
                ];
            }
            DB::table('notification_list')->insert($dataSet);

            return redirect('educatorAddAssignmentPage')->with('pass_status', 'Assignment Added Successfully.');
        }
    }

    public function editAssignment(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $assignment_title = $request->input('assignment_title');
        $assignment_due_date = $request->input('assignment_due_date');
        $assignment_full_mark = $request->input('assignment_full_mark');
        $assignment_folder = $request->input('assignment_folder');
        $assignment_content = $request->input('assignment_content');

        $assignment_data = array(
            "assignment_title" => $assignment_title,
            "assignment_due_date" => $assignment_due_date,
            "assignment_full_mark" => $assignment_full_mark,
            "subject_folder_id" => $assignment_folder,
            "assignment_content" => $assignment_content,
        );

        if ($assignment_title == NULL || $assignment_content == NULL) {
            return redirect('educatorAddAssignmentPage')->with('error_status', 'Please enter a assignment title or content cannot be empty!');
        } else {
            DB::table('assignment_list')->where('assignment_id', $edit_id)->update($assignment_data);
            //Fetch the student name from the student list that are in this notification class
            $count = DB::table('student_list')->select('student_id')->where('student_class', Session::get('current_class_name'))->get();

            //Notify the course student
            $title = "Update on Assignment for Course: " . Session::get('current_subject_code');
            $msg = "Assignment: " . $assignment_title . " has been updated in class content, please check for the latest changes. The due date is on: " . $assignment_due_date . ". Please submit it before the due date. Thank you.";
            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

            //Add each student and status for this current notification
            foreach ($count as $c) {
                $dataSet[] = [
                    'user_id'  => $c->student_id,
                    'notification_title'    => $title,
                    'notification_content'       => $msg,
                    'created_at'    => $current_date_time,
                    'read_notification_status'       => 0,
                ];
            }
            DB::table('notification_list')->insert($dataSet);

            return redirect('educatorAddAssignmentPage')->with('pass_status', 'Assignment Added Successfully.');
        }
    }

    public function deleteAssignment(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('assignment_list')->where('assignment_id', [$id])->delete();
        return back()->with('delete_status', 'Assignment Deleted Successfully! ');
    }
}
