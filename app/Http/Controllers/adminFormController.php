<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class adminFormController extends Controller
{
    public function addForm(Request $request){
        $form_name = $request->input('form_name');
        $form_level = $request->input('form_level');
    
        $this->validate($request, [
            'form_name' => 'required',         
            'form_level' => 'required|numeric|max:6',
            ]);
        
        $check_duplicate = DB::select('select * from form_list where form_name = ?', [$form_name]);

        if($check_duplicate != null){  
            return redirect('adminAddForm')->with('error_status', 'Failed, please try again with different name!');      
        }else{
            $result = DB::select('insert into form_list (form_name, form_level) values (?,?)' , [$form_name , $form_level]);
            return redirect('adminAddForm')->with('pass_status', 'New Form added successfully!');
        }
    }

    public function deleteForm(Request $request){
        $delete_form = $request->input('delete_form');

        DB::table('form_list')->where('form_name',[$delete_form])->delete(); 
        return redirect('adminAddForm')->with('delete_status', 'Form deleted successfully! ');
    }

}