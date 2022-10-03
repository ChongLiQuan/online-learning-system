<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentAnnouncementController extends Controller
{
    public function studentAnnouncementPage(Request $request)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $username = Session::get('username');
            $list = DB::table('announcement_list')
                ->join('class_subject_list', 'class_subject_list.class_subject_id', '=', 'announcement_list.class_subject_id')
                ->where('class_subject_list.class_name', Session::get('user_class'))
                ->orderBy('announcement_list.created_at', 'DESC')
                ->paginate(10);
            return view('student/studentAnnouncementPage', compact('list'));
        }
    }

    public function readAnnouncement(Request $request)
    {
        $id = $request->input('announcement_id');

        $data = array(
            "annouce_status" => 1,
        );

        DB::table('announcement_status')->where('student_id', Session::get('username'))->where('annouce_id', $id)->update($data);
        return redirect('studentAnnouncementPage')->with('delete_status', 'Announcement Read Successfully! ');
    }
}
