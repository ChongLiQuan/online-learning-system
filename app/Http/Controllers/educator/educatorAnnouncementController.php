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

            $annouce_id = DB::table('announcement_list')->where('created_at', $annouce_date)->pluck('id')->first();

            $count = DB::table('student_list')->select('student_name')->where('student_class', $annouce_class)->get();

            foreach ($count as $c) {
                $dataSet[] = [
                    'student_name'  => $c->student_name,
                    'annouce_id'    => $annouce_id,
                    'status'       => 0,
                ];
            }

            DB::table('announcement_status')->insert($dataSet);


            return redirect('educatorAddAnnouncement')->with('pass_status', 'Announcement Published Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
        }
    }

    public function deleteAnnouncement(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('announement_list')->where('id', [$id])->delete();
        return redirect('educatorAnnouncement')->with('delete_status', 'Announcement Deleted Successfully! ');
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
            return redirect('educatorAnnouncement')->with('delete_status', 'Error! Selected Subject or Class Name Does Not Exist!');
        } else {
            DB::table('announcement_list')->where('id', $edit_id)->update($data);

            DB::table('announcement_status')->where('annouce_id', [$edit_id])->delete();

            $count = DB::table('student_list')->select('student_name')->where('student_class', $annouce_class)->get();

            foreach ($count as $c) {
                $dataSet[] = [
                    'student_name'  => $c->student_name,
                    'annouce_id'    => $edit_id,
                    'status'       => 0,
                ];
            }

            DB::table('announcement_status')->insert($dataSet);



            return redirect('educatorAnnouncement')->with('delete_status', 'Announcement Edited Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
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
