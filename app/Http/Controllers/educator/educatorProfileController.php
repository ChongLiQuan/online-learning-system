<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class educatorProfileController extends Controller
{
    public function educatorProfilePage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
            $announcement = DB::table('announcement_list')
                ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'announcement_list.class_subject_id')
                ->where('class_subject_list.class_name', Session::get('user_class'))
                ->orderBy('announcement_list.created_at', 'DESC')
                ->get();
            $profile = DB::table('educator_list')->where('edu_id', Session::get('username'))->get();

            //Fetching all the assignment that belong to the logged in educator
            $allAssignment = DB::table('assignment_list')
                ->join('subject_folder_list', 'subject_folder_list.subject_folder_id', '=', 'assignment_list.subject_folder_id')
                ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'subject_folder_list.class_subject_id')
                ->where('class_subject_list.educator_id', Session::get('username'))
                ->orderBy('assignment_list.assignment_id', 'asc')
                ->paginate(5);


            return view('educator/educatorProfilePage', compact('subjects', 'announcement', 'profile', 'allAssignment'));
        }
    }

    public function updatePassword(Request $request)
    {
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');

        $database_password = DB::table('user_login_details')->where('user_name', Session::get('username'))->pluck('user_password')->first();

        if (Hash::check($current_password, $database_password)) {
            $hash_new_password = Hash::make($new_password);
            DB::table('user_login_details')->where('user_name', Session::get('username'))->update(['user_password' => $hash_new_password]);

            return redirect()->action('App\Http\Controllers\educator\educatorProfileController@educatorProfilePage')->with('pass_status', 'Password has been changed sucessfully!');
        } else { //If the user enter the wrong password as the database password

            return redirect()->action('App\Http\Controllers\educator\educatorProfileController@educatorProfilePage')->with('error_status', 'Please enter the correct password!');
        }
    }

    public function updateEmailStatus(Request $request)
    {
        $edit_id = $request->input('edit_id');
        $button_value = $request->input('button_value');

        DB::table('assignment_list')->where('assignment_id', $edit_id)->update(['assignment_email_educator_status' => $button_value]);

        return redirect()->action('App\Http\Controllers\educator\educatorProfileController@educatorProfilePage');
    }
}
