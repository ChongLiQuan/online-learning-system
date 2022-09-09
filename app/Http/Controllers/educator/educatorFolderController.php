<?php

namespace App\Http\Controllers\educator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class educatorFolderController extends Controller
{
    public function addFolder(Request $request)
    {
        $subject_folder_name = $request->input('subject_folder_name');
        $class_subject_id = $request->input('class_subject_id');
        $subject_folder_content = $request->input('subject_folder_content');
        $subject_subFolder = $request->input('subject_subFolder');

        if ($subject_folder_name == NULL) {
            return redirect('educatorAddFolder')->with('error_status', 'Please enter a folder name!');
        } else {
            DB::select('insert into subject_folder_list (subject_folder_name, class_subject_id, subject_folder_content, subject_subFolder) 
            values (?,?,?,?)', [$subject_folder_name, $class_subject_id, $subject_folder_content, $subject_subFolder]);


            return redirect('educatorAddFolder')->with('pass_status', 'Folder Added Successfully.');
        }
    }

    public function editFolder(Request $request)
    {
        $edit_id = $request->input('edit_id');

        $subject_folder_name = $request->input('subject_folder_name');
        $subject_folder_content = $request->input('subject_folder_content');
        $subject_subFolder = $request->input('subject_subFolder');

        $this->validate($request, [
            'subject_folder_name' => 'required',
        ]);

        $data = array(
            "subject_folder_name" => $subject_folder_name,
            "subject_folder_content" => $subject_folder_content,
            "subject_subFolder" => $subject_subFolder,
        );

        if ($subject_folder_name == NULL) {
            return redirect('educatorEditFolder')->with('error_status', 'Please enter a folder name!');
        } else {
            DB::table('subject_folder_list')->where('subject_folder_id', $edit_id)->update($data);
            return back()->with('pass_status', 'Folder Edited Successfully.');
        }
    }

    public function deleteFolder(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('subject_folder_list')->where('subject_folder_id', [$id])->delete();
        DB::table('subject_folder_list')->where('subject_subFolder', [$id])->delete();

        return back()->with('delete_status', 'Folder Deleted Successfully! ');
    }
}
