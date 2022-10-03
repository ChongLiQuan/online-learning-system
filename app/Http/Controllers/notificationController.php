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
            $list = DB::table('notification_list')->where('user_id', Session::get('username'))->orderBy('created_at', 'DESC')->paginate(10);
            return view('/notificationPage', compact('list'));
        }
    }

    public function readNotification(Request $request)
    {
        $id = $request->input('id');

        DB::table('notification_list')->where('notification_id', [$id])->where('user_id', Session::get('username'))->update(['read_notification_status' => 1]);

        return redirect('/notificationPage')->with('delete_status', 'Read Notification Successfully');
    }

    public function deleteNotification(Request $request)
    {
        $id = $request->input('id');

        DB::table('notification_list')->where('notification_id', [$id])->where('user_id', Session::get('username'))->delete();

        return redirect('/notificationPage')->with('delete_status', 'Notification Deleted Successfully');
    }
}
