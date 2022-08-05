<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminEducatorController extends Controller
{
    public function addEducator(Request $request){
        $edu_name = $request->input('edu_name');
        $edu_IC = $request->input('edu_IC');
        $edu_year = $request->input('edu_year');
        $edu_age = $request->input('edu_age');
        $edu_address = $request->input('edu_address');
        $edu_email = $request->input('edu_email');
        $edu_gender = $request->input('edu_gender');
        $edu_dob = $request->input('edu_dob');

        $this->validate($request, [
            'edu_name' => 'required',
            'edu_IC' => 'required|digits:12',
            'edu_year' => 'required|integer|between:0,60',
            'edu_age' => 'required|integer|between:18,50',
            'edu_address' => 'required',
            'edu_email' => 'required',
            'edu_gender' => 'required',
            'edu_dob' => 'required',
            ]);

        $check_duplicate = DB::select('select edu_IC from educator_list where edu_IC = ?', [$edu_IC]);

        if($check_duplicate != null){  
            return redirect('adminAddEducator')->with('error_status', 'Failed, IC has been registered in thes system!');      
        }else{
            DB::select('insert into educator_list (edu_name, edu_IC, edu_year, edu_age, edu_address, edu_email, edu_gender, edu_dob) 
            values (?,?,?,?,?,?,?,?)' , [$edu_name, $edu_IC, $edu_year, $edu_age, $edu_address, $edu_email, $edu_gender, $edu_dob]);
            return redirect('adminAddEducator')->with('pass_status', 'New Educator registered successfully');
        }
    
    }

    public function deleteEducator(Request $request){
        $delete_edu = $request->input('delete_edu');

        DB::table('educator_list')->where('edu_id',[$delete_edu])->delete(); 
        return redirect('adminAddEducator')->with('delete_status', 'Form deleted successfully! ');
    }

}
