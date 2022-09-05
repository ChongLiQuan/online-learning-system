<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class educatorContentController extends Controller
{
    public function addContent(Request $request)
    {
        $content_title = $request->input('content_title');
        $folder_id = $request->input('folder_id');
        $content = $request->input('content');
        

        if ($content_title == NULL || $folder_id == NULL) {
            return redirect('educatorAddContent')->with('error_status', 'Please enter a content title or select a sub-folder!');
        } else {
            DB::select('insert into folder_content_list (folder_content_title, folder_content, folder_id) 
            values (?,?,?)', [$content_title, $content, $folder_id]);

            return redirect('educatorAddContent')->with('pass_status', 'Content Added Successfully.');
        }
    }

    public function editContent(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $content_title = $request->input('content_title');
        $folder_id = $request->input('folder_id');
        $content = $request->input('content');

        $data = array(
            "folder_content_title" => $content_title,
            "folder_content" => $content,
            "folder_id" => $folder_id,
        );

        if ($content_title == NULL || $folder_id == NULL) {
            return redirect('educatorAddContent')->with('error_status', 'Please enter a content title or select a sub-folder!');
        } else {
            DB::table('folder_content_list')->where('folder_content_id', $edit_id)->update($data);

            return back()->with('pass_status', 'Content Edited Successfully.');
        }

    }

    public function deleteContent(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('folder_content_list')->where('folder_content_id', [$id])->delete();
        return back()->with('delete_status', 'Content Deleted Successfully! ');
    }
}
