<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminAssignSubjectController extends Controller
{
    public function assignSubject(Request $request)
    {
        $subject = $request->input('subject');
        $class = $request->input('class');
        $educator = $request->input('educator');

        $this->validate($request, [
            'subject' => 'required',
            'class' => 'required',
            'educator' => 'required',
        ]);

        $check_duplicate = DB::select('select * from class_subject_list where subject_code = ? and class_name = ? and educator_id = ?', [$subject, $class, $educator]);

        if ($check_duplicate != null) {
            return redirect('adminAssignSubject')->with('error_status', 'Failed, please try again with different subject name or code!');
        } else {
            DB::select('insert into class_subject_list (subject_code, class_name, educator_id) values (?,?,?)', [$subject, $class, $educator]);
            return redirect('adminAssignSubject')->with('pass_status', 'Subject Assigned Successfully!');
        }
    }

    public function deleteAssign(Request $request)
    {
        $delete = $request->input('delete');

        DB::table('class_subject_list')->where('id', [$delete])->delete();
        return redirect('adminAddEducator')->with('delete_status', 'Class Removed successfully! ');
    }
}
