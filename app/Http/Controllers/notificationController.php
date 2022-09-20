<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class notificationController extends Controller
{
    public function notificationView()
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('username');
            $list = DB::table('notification_list')->where('user_id', Session::get('username'))->orderBy('created_at', 'DESC')->get();
            return view('/notification', compact('list'));
        }
    }

    public function readNotification(Request $request)
    {
        $id = $request->input('id');

        DB::table('notification_list')->where('notification_id', [$id])->update(['read_notification_status' => 1]);

        return redirect('/notification')->with('pass_status', 'Read Notification Successfully');
    }
}
