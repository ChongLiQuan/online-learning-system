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

    public function editFolder(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $folder_name = $request->input('folder_name');
        $folder_content = $request->input('folder_content');
        $subFolder = $request->input('subFolder');

        $this->validate($request, [
            'folder_name' => 'required',
        ]);

        $data = array(
            "folder_name" => $folder_name,
            "folder_content" => $folder_content,
            "subFolder" => $subFolder,
        );

        if ($folder_name == NULL) {
            return redirect('educatorEditFolder')->with('error_status', 'Please enter a folder name!');
        } else {
            DB::table('folder_list')->where('folder_id', $edit_id)->update($data);
            return back()->with('pass_status', 'Folder Edited Successfully.');
        }
    }

    public function deleteFolder(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('folder_list')->where('folder_id', [$id])->delete();
        DB::table('folder_list')->where('subFolder', [$id])->delete();

        return back()->with('delete_status', 'Folder Deleted Successfully! ');
    }
}
