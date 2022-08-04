<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class adminClassController extends Controller
{
    public function addClass(Request $request){
        $class_name = $request->input('class_name');
        $form_name = $request->input('form_name');

        $this->validate($request, [
            'class_name' => 'required',         
            ]);

        $check_duplicate = DB::select('select * from class_list where class_name = ?', [$class_name]);

        if($check_duplicate != null){  
            return redirect('adminAddClass')->with('error_status', 'Failed, please try again with different class name!');      
        }else{
            $result = DB::select('insert into class_list (class_name, form_name) values (?,?)' , [$class_name, $form_name]);
            return redirect('adminAddClass')->with('pass_status', 'New Class added successfully!');
        }
    
    }

    public function deleteClass(Request $request){
        $delete_class = $request->input('delete_class');

        DB::table('class_list')->where('class_name',[$delete_class])->delete(); 
        return redirect('adminAddClass')->with('delete_status', $delete_class . ' Deleted Successfully! ');
    }

    public function filterClass(Request $request){
        $filter_form = $request->input('filter_form');

        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->where('form_name',[$filter_form])->get(); 
        return view('admin/adminAddClass',compact('forms','classes'));
    }
}
