<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class educatorAnnoucementController extends Controller
{

    public function addAnnoucement(Request $request)
    {
        $annouce_educator = $request->input('annouce_edu');
        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_class = $request->input('annouce_class');
        $annouce_content = $request->input('annouce_content');
        $annouce_date = NOW();

        //Check if the class exist for the specific subject
        $checker = DB::select('select * from class_subject_list where subject_code = ? and class_name = ?', [$annouce_subject, $annouce_class]);

        if ($checker == NULL) {
            return redirect('educatorAddAnnoucement')->with('error_status', 'Error! Selected Subject or Class Name Does Not Exist!');
        } else {
            DB::select('insert into annoucement_list (annouce_title, annouce_subject, annouce_class, annouce_content, annouce_educator, created_at) 
            values (?,?,?,?,?,?)', [$annouce_title, $annouce_subject, $annouce_class, $annouce_content, $annouce_educator, $annouce_date]);

            $annouce_id = DB::table('annoucement_list')->where('created_at', $annouce_date)->pluck('id')->first();

            $count = DB::table('student_list')->select('student_name')->where('student_class', $annouce_class)->get();
            
            foreach($count as $c) {
                $dataSet[] = [
                    'student_name'  => $c->student_name,
                    'annouce_id'    => $annouce_id,
                    'status'       => 0,
                ];
            }

            DB::table('annoucement_status')->insert($dataSet);


            return redirect('educatorAddAnnoucement')->with('pass_status', 'Annoucement Published Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
        }
    }

    public function deleteAnnoucement(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('annoucement_list')->where('id', [$id])->delete();
        return redirect('educatorEditAnnoucement')->with('delete_status', 'Annoucement Deleted Successfully! ');
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
