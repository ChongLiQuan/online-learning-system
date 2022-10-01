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

    public function educatorMarkAssignmentPage($submission_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('user_full_name');
            $subjects = DB::table('class_subject_list')->where('educator_id', Session::get('username'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('annouce_id', 'DESC')->get();
            $folders = DB::table('student_note_folder_list')->where('student_id', Session::get('username'))->orderBy('student_folder_id', 'ASC')->get();

            $assignment = DB::table('assignment_submission_list')
                ->join('assignment_list', 'assignment_list.assignment_id', '=', 'assignment_submission_list.assignment_id')
                ->where('assignment_submission_list.submission_id', $submission_id)
                ->get();

            return view('educator/educatorMarkAssignmentPage', compact('subjects', 'announcement', 'folders', 'assignment'));
        }
    }

    public function educatorRemarkAssignmentPage($submission_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('user_full_name');
            $subjects = DB::table('class_subject_list')->where('educator_id', Session::get('username'))->orderBy('class_subject_id')->get();

            $assignment = DB::table('assignment_submission_list')
                ->join('assignment_list', 'assignment_list.assignment_id', '=', 'assignment_submission_list.assignment_id')
                ->where('assignment_submission_list.submission_id', $submission_id)
                ->get();

            return view('educator/educatorRemarkAssignmentPage', compact('subjects', 'assignment'));
        }
    }

    public function educatorViewSubmissionPage($assignment_id)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $assignment = DB::table('assignment_list')->where('assignment_id', $assignment_id)->get();
            $submission = DB::table('assignment_submission_list')->where('assignment_id', $assignment_id)->get();

            $class_id = DB::table('assignment_list')
                ->join('subject_folder_list', 'subject_folder_list.subject_folder_id', '=', 'assignment_list.subject_folder_id')
                ->where('assignment_list.assignment_id', $assignment_id)
                ->pluck('class_subject_id')
                ->first();

            $class = DB::table('class_subject_list')->where('class_subject_id', $class_id)->pluck('class_name')->first();

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
            Session::put('current_class_name', $class);
            Session::put('current_course_url',  route('courseHome', ['id' => $class_id]));

            //Count student from the class
            $student = DB::table('student_list')->where('student_class', $class)->get();
            $totalStudent = count($student);
            $totalSubmission = count($submission);

            return view('educator/educatorViewSubmissionPage', compact('assignment', 'submission', 'totalStudent', 'totalSubmission'));
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

    public function educatorMarkAssignment(Request $request)
    {
        $edit_id = $request->input('edit_id');
        $submission_mark = $request->input('submission_mark');
        $assignment_id = $request->input('assignment_id');
        $assignment_feedback = $request->input('assignment_feedback');

        $submission_data = array(
            "submission_mark" => $submission_mark,
            "submission_educator_feedback" => $assignment_feedback,
        );

        DB::table('assignment_submission_list')->where('submission_id',$edit_id)->update($submission_data);

        return redirect()->route('educatorViewSubmissionPage', $assignment_id)->with('alert', 'Assignment Makred Successfully.');
    }

    public function addAssignment(Request $request)
    {
        $assignment_title = $request->input('assignment_title');
        $assignment_due_date = $request->input('assignment_due_date');
        $assignment_full_mark = $request->input('assignment_full_mark');
        $assignment_folder = $request->input('assignment_folder');
        $assignment_content = $request->input('assignment_content');
        $assignment_email_educator_status = $request->input('assignment_email_educator_status');

        $assignment_data = array(
            "assignment_title" => $assignment_title,
            "assignment_due_date" => $assignment_due_date,
            "assignment_full_mark" => $assignment_full_mark,
            "subject_folder_id" => $assignment_folder,
            "assignment_content" => $assignment_content,
            "assignment_email_educator_status" => $assignment_email_educator_status,
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
