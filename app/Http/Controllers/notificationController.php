<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class notificationController extends Controller
{
    public function notificationPage()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('username');
            $list = DB::table('notification_list')->where('user_id', Session::get('username'))->orderBy('created_at', 'DESC')->get();
            return view('/notificationPage', compact('list'));
        }
    }

    public function readNotification(Request $request)
    {
        $id = $request->input('id');

        DB::table('notification_list')->where('notification_id', [$id])->update(['read_notification_status' => 1]);

        return redirect('/notificationPage')->with('pass_status', 'Read Notification Successfully');
    }
}
