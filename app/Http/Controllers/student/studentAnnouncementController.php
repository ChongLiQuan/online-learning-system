<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class studentAnnouncementController extends Controller
{
    public function readAnnouncement(Request $request)
    {
        $id = $request->input('announcement_id');

        $data = array(
            "status" => 1,
      );

        DB::table('announcement_status')->where('student_name', Session::get('username'))->where('annouce_id', $id)->update($data);
        return redirect('studentAnnouncement')->with('delete_status', 'Announcement Read Successfully! ');
    }
}
