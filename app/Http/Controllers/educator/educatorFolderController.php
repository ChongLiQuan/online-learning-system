<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class educatorFolderController extends Controller
{
    public function addFolder(Request $request)
    {
        $folder_name = $request->input('folder_name');
        $class_subject_id = $request->input('class_subject_id');
        $folder_content = $request->input('folder_content');
        $subFolder = $request->input('subFolder');

        if ($folder_name == NULL) {
            return redirect('educatorAddFolder')->with('error_status', 'Please enter a folder name!');
        } else {
            DB::select('insert into folder_list (folder_name, class_subject_id, folder_content, subFolder) 
            values (?,?,?,?)', [$folder_name, $class_subject_id, $folder_content, $subFolder]);


            return redirect('educatorAddFolder')->with('pass_status', 'Folder Added Successfully.');
        }
    }

    public function deleteFolder(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('folder_list')->where('folder_id', [$id])->delete();
        return back()->with('delete_status', 'Folder Deleted Successfully! ');
    }
}
