<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class educatorAnnouncementController extends Controller
{
    public function educatorAnnouncementPage(Request $request)
    {
        if (Session::get('username') == null) {
            return view('userInvalidSession');
        } else {
            $user_full_name = Session::get('user_full_name');
            $list = DB::table('announcement_list')->where('annouce_educator', $user_full_name)->orderBy('created_at', 'DESC')->paginate(10);
            return view('educator/educatorAnnouncementPage', compact('list'));
        }
    }

    public function addAnnouncement(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $annouce_educator = $request->input('annouce_edu');
        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_content = $request->input('annouce_content');
        $annouce_date = $current_date_time;

        if ($annouce_title == NULL) {
            return redirect('educatorAddAnnouncement')->with('error_status', 'Error! Please enter an Announcement Title!');
        } else {
            DB::select('insert into announcement_list (annouce_title, class_subject_id, annouce_content, annouce_educator, created_at) 
            values (?,?,?,?,?)', [$annouce_title, $annouce_subject, $annouce_content, $annouce_educator, $annouce_date]);

            //Fetch the current created auto incremented announcement id
            $annouce_id = DB::table('announcement_list')->where('created_at', $annouce_date)->pluck('annouce_id')->first();

            //Fetch the student name from the student list that are in this announcement class
            $class = DB::table('class_subject_list')->where('class_subject_id', $annouce_subject)->pluck('class_name')->first();
            $count = DB::table('student_list')->select('student_id')->where('student_class', $class)->get();

            //Add each student and status for this current announcement
            foreach ($count as $c) {
                $dataSet[] = [
                    'student_id'  => $c->student_id,
                    'annouce_id'    => $annouce_id,
                    'annouce_status'       => 0,
                ];
            }
            DB::table('announcement_status')->insert($dataSet);
            return redirect('educatorAddAnnouncement')->with('pass_status', 'Announcement Published Successfully For Course ' . $annouce_subject . ' ' . $class);
        }
    }

    public function deleteAnnouncement(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('announcement_list')->where('annouce_id', [$id])->delete();
        return redirect('educatorAnnouncementPage')->with('delete_pass_status', 'Announcement Deleted Successfully! ');
    }

    public function editAnnouncement(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_content = $request->input('annouce_content');

        $this->validate($request, [
            'annouce_title' => 'required',
            'annouce_subject' => 'required',
            'annouce_content' => 'required',
        ]);

        $data = array(
            "annouce_title" => $annouce_title,
            "class_subject_id" => $annouce_subject,
            "annouce_content" => $annouce_content,
            'annouce_educator' => Session::get('user_full_name'),
            'updated_at' => NOW(),
        );

        if ($annouce_title == NULL) {
            return redirect('educatorAnnouncementPage')->with('delete_error_status', 'Error! Selected Subject or Class Name Does Not Exist!');
        } else {
            DB::table('announcement_list')->where('annouce_id', $edit_id)->update($data);

            DB::table('announcement_status')->where('annouce_id', [$edit_id])->delete();

            $class = DB::table('class_subject_list')->where('class_subject_id', $annouce_subject)->pluck('class_name')->first();
            $count = DB::table('student_list')->select('student_id')->where('student_class', $class)->get();
            $count_int = count($count); //Convert the dara into integer to do comparison for the validation below

            //Check if the selected class is empty 
            if ($count_int > 0) {
                foreach ($count as $c) {
                    $dataSet[] = [
                        'student_id'  => $c->student_id,
                        'annouce_id'    => $edit_id,
                        'annouce_status'       => 0,
                    ];
                }

                DB::table('announcement_status')->insert($dataSet);
            } else { //Prompty error message for empty class
                return redirect('educatorAnnouncementPage')->with('delete_error_status', 'Error! Selected Class is Empty!');
            }

            return redirect('educatorAnnouncementPage')->with('delete_pass_status', 'Announcement Edited Successfully For Course ' . $annouce_subject . ' ' . $class);
        }
    }
}
