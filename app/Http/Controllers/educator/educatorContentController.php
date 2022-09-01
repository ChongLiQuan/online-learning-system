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

        if ($content_title == NULL) {
            return redirect('educatorAddContent')->with('error_status', 'Please enter a content title!');
        } else {
            DB::select('insert into folder_content_list (content_title, content, folder_id) 
            values (?,?,?)', [$content_title, $content, $folder_id]);


            return redirect('educatorAddContent')->with('pass_status', 'Content Added Successfully.');
        }
    }

    public function deleteFolder(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('folder_content_list')->where('content_id', [$id])->delete();
        return back()->with('delete_status', 'Folder Deleted Successfully! ');
    }
}
