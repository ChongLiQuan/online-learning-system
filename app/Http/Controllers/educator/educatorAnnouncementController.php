<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class educatorAnnouncementController extends Controller
{

    public function addAnnouncement(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $annouce_educator = $request->input('annouce_edu');
        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_class = $request->input('annouce_class');
        $annouce_content = $request->input('annouce_content');
        $annouce_date = $current_date_time;

        //Check if the class exist for the specific subject
        $checker = DB::select('select * from class_subject_list where subject_code = ? and class_name = ?', [$annouce_subject, $annouce_class]);

        if ($checker == NULL) {
            return redirect('educatorAddAnnouncement')->with('error_status', 'Error! Selected Subject or Class Name Does Not Exist!');
        } else {
            DB::select('insert into announcement_list (annouce_title, annouce_subject, annouce_class, annouce_content, annouce_educator, created_at) 
            values (?,?,?,?,?,?)', [$annouce_title, $annouce_subject, $annouce_class, $annouce_content, $annouce_educator, $annouce_date]);

            //Fetch the current created auto incremented announcement id
            $annouce_id = DB::table('announcement_list')->where('created_at', $annouce_date)->pluck('annouce_id')->first();

            //Fetch the student name from the student list that are in this announcement class
            $count = DB::table('student_list')->select('student_name')->where('student_class', $annouce_class)->get();

            //Add each student and status for this current announcement
            foreach ($count as $c) {
                $dataSet[] = [
                    'student_name'  => $c->student_name,
                    'annouce_id'    => $annouce_id,
                    'annouce_status'       => 0,
                ];
            }
            DB::table('announcement_status')->insert($dataSet);
            return redirect('educatorAddAnnouncement')->with('pass_status', 'Announcement Published Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
        }
    }

    public function deleteAnnouncement(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('announcement_list')->where('annouce_id', [$id])->delete();
        return redirect('educatorAnnouncement')->with('delete_pass_status', 'Announcement Deleted Successfully! ');
    }

    public function editAnnouncement(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_class = $request->input('annouce_class');
        $annouce_content = $request->input('annouce_content');

        $this->validate($request, [
            'annouce_title' => 'required',
            'annouce_subject' => 'required',
            'annouce_class' => 'required',
            'annouce_content' => 'required',
        ]);

        $data = array(
            "annouce_title" => $annouce_title,
            "annouce_subject" => $annouce_subject,
            "annouce_class" => $annouce_class,
            "annouce_content" => $annouce_content,
            'annouce_educator' => Session::get('username'),
            'updated_at' => NOW(),
        );

        //Check if the class exist for the specific subject
        $checker = DB::select('select * from class_subject_list where subject_code = ? and class_name = ?', [$annouce_subject, $annouce_class]);

        if ($checker == NULL) {
            return redirect('educatorAnnouncement')->with('delete_error_status', 'Error! Selected Subject or Class Name Does Not Exist!');
        } else {
            DB::table('announcement_list')->where('annouce_id', $edit_id)->update($data);

            DB::table('announcement_status')->where('annouce_id', [$edit_id])->delete();

            $count = DB::table('student_list')->select('student_name')->where('student_class', $annouce_class)->get();
            $count_int = count($count); //Convert the dara into integer to do comparison for the validation below
            
            //Check if the selected class is empty 
            if($count_int > 0){
                foreach ($count as $c) {
                    $dataSet[] = [
                        'student_name'  => $c->student_name,
                        'annouce_id'    => $edit_id,
                        'annouce_status'       => 0,
                    ];
                }

                DB::table('announcement_status')->insert($dataSet);

            }else{ //Prompty error message for empty class
                return redirect('educatorAnnouncement')->with('delete_error_status', 'Error! Selected Class is Empty!');
            }

            return redirect('educatorAnnouncement')->with('delete_pass_status', 'Announcement Edited Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
