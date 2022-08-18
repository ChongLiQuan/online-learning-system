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
            $form_id = DB::table('form_list')->where('form_name', $form_name)->pluck('form_id')->first();
            DB::select('insert into class_list (class_name, form_id) values (?,?)' , [$class_name, $form_id]);
            return redirect('adminAddClass')->with('pass_status', 'New Class added successfully!');
        }
    
    }

    public function editClassRoute(Request $request)
    {
        $edit_class = $request->input('edit_class');

        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $class = DB::table('class_list')->where('class_id', $edit_class)->get();
        return view('admin/adminEditClass', compact('class','forms'));
    }


    public function editClass(Request $request)
    {
        $class_name = $request->input('class_name');
        $form_name = $request->input('form_name');
        $class_id = $request->input('class_id');

        $this->validate($request, [
            'class_name' => 'required',
            'form_name' => 'required',
        ]);

        $form_id = DB::table('form_list')->where('form_name', $form_name)->pluck('form_id')->first();

        $data = array(
            "class_name" => $class_name,
            "form_id" => $form_id,
        );

        $check_duplicate = DB::select('select class_name from class_list where class_name = ?', [$class_name]);
        $count = count($check_duplicate);

        if ($count > 1) {

            return redirect('adminAddClass')->with('error_status', 'Class Information Updated Failed, Class Name has been taken! ');

        } else {
            DB::table('class_list')->where('class_id', $class_id)->update($data);
            return redirect('adminAddClass')->with('pass_status', 'Class Information Updated Successfully! ');
        }
    }

    public function deleteClass(Request $request){
        $delete_class = $request->input('delete_class');

        DB::table('class_list')->where('class_name',[$delete_class])->delete(); 
        return redirect('adminAddClass')->with('delete_status', $delete_class . ' Deleted Successfully! ');
    }

    public function filterClass(Request $request){
        $filter_form = $request->input('filter_form');

        $forms = DB::table('form_list')->orderBy('form_level')->get(); //To display as the drop-down option
        
        $selectedFormLevel = DB::table('form_list')->where('form_level',[$filter_form])->pluck('form_id')->first();  //To fetch the filtered data from database form_list
        $classes = DB::table('class_list')->where('form_id',[$selectedFormLevel])->get();  //To fetch the filtered data from database class_list
        return view('admin/adminAddClass',compact('forms','classes'));
    }
}
