<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class studentProfileController extends Controller
{
    public function studentProfilePage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $profile = DB::table('student_list')->where('student_id', Session::get('username'))->get();

            //Fetch all assignment that belong to student class
            $allAssignment = DB::table('assignment_submission_list')
                ->join('assignment_list', 'assignment_list.assignment_id', '=', 'assignment_submission_list.assignment_id')
                ->where('assignment_submission_list.student_id', Session::get('username'))
                ->orderBy('assignment_submission_list.submission_id', 'asc')
                ->paginate(5);

            return view('student/studentProfilePage', compact('profile', 'allAssignment'));
        }
    }

    public function studentUpdatePassword(Request $request)
    {
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');

        $database_password = DB::table('user_login_details')->where('user_name', Session::get('username'))->pluck('user_password')->first();

        if (Hash::check($current_password, $database_password)) {
            $hash_new_password = Hash::make($new_password);
            DB::table('user_login_details')->where('user_name', Session::get('username'))->update(['user_password' => $hash_new_password]);

            return redirect()->action('App\Http\Controllers\student\studentProfileController@studentProfilePage')->with('pass_status', 'Password has been changed sucessfully!');
        } else { //If the user enter the wrong password as the database password

            return redirect()->action('App\Http\Controllers\student\studentProfileController@studentProfilePage')->with('error_status', 'Please enter the correct password!');
        }
    }
}
