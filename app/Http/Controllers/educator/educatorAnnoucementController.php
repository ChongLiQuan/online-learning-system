<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDO;

class educatorAnnoucementController extends Controller
{

    public function addAnnoucement(Request $request)
    {
        $annouce_educator = $request->input('annouce_edu');
        $annouce_title = $request->input('annouce_title');
        $annouce_subject = $request->input('annouce_subject');
        $annouce_class = $request->input('annouce_class');
        $annouce_content = $request->input('annouce_content');



        DB::select('insert into annoucement_list (annouce_title, annouce_subject, annouce_class, annouce_content, annouce_educator, created_at) 
            values (?,?,?,?,?,?)', [$annouce_title, $annouce_subject, $annouce_class, $annouce_content, $annouce_educator, NOW()]);

        return redirect('educatorAddAnnoucement')->with('pass_status', 'Annoucement Published Successfully For Course ' . $annouce_subject . ' ' . $annouce_class);
    }

    public function deleteAnnoucement(Request $request){
        $id = $request->input('delete_id');

        DB::table('annoucement_list')->where('id',[$id])->delete(); 
        return redirect('educatorEditAnnoucement')->with('delete_status','Annoucement Deleted Successfully! ');
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
