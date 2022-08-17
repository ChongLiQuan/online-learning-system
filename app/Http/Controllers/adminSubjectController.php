<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminSubjectController extends Controller
{
    public function addSubject(Request $request){
        $subject_code = $request->input('subject_code');
        $subject_name = $request->input('subject_name');
        $form_level = $request->input('form_level');

        $this->validate($request, [
            'subject_code' => 'required',
            'subject_name' => 'required',
            ]);

        $check_duplicate = DB::select('select * from subject_list where subject_code = ?', [$subject_code]);

        if($check_duplicate != null){  
            return redirect('adminAddSubject')->with('error_status', 'Failed, please try again with different subject name or code!');      
        }else{
            $form_id = DB::table('form_list')->where('form_level', $form_level)->pluck('form_id')->first();
            DB::select('insert into subject_list (subject_code, subject_name, form_id) values (?,?,?)' , [$subject_code, $subject_name, $form_id]);
            return redirect('adminAddSubject')->with('pass_status', 'New Subject added successfully into Class');
        }
    
    }

    public function deleteSubject(Request $request){
        $delete_subject = $request->input('delete_subject');

        DB::table('subject_list')->where('subject_code',[$delete_subject])->delete(); 
        return redirect('adminAddSubject')->with('delete_status', $delete_subject . ' Deleted Successfully! ');
    }

    public function filterSubject(Request $request){
        $filter_form = $request->input('filter_form');

        $classes = DB::table('class_list')->orderBy('form_id')->get();
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $subjects = DB::table('subject_list')->where('form_id',[$filter_form])->get(); 
        return view('admin/adminAddSubject',compact('forms','classes','subjects'));
    }
}
