<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class messageController extends Controller
{
    public function userMessagePage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $allUsers = DB::table('user_login_details')->get();

            $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
            $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
            return view('userMessagePage', compact('list', 'allUsers'));
        }
    }

    public function loadMessage($to_student_id)
    {
        Session::put('to_student_id', $to_student_id);
        $allUsers = DB::table('user_login_details')->get();

        return view('userMessagePage', compact('allUsers'));
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $data = array(
            "to_user_id" => Session::get('to_student_id'),
            "from_user_id" => Session::get('username'),
            "message_content" => $message,
            "message_date" => $current_date_time,
            "message_is_new_status" => 1,
        );

        DB::table('messages_list')->insert($data);
        return redirect()->action('App\Http\Controllers\messageController@userMessagePage');
    }
}
