<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class adminEducatorController extends Controller
{
    public function addEducator(Request $request)
    {
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

        if ($check_duplicate != null) {
            return redirect('adminAddEducator')->with('error_status', 'Failed, IC has been registered in thes system!');
        } else {
            DB::select('insert into educator_list (edu_name, edu_IC, edu_year, edu_age, edu_address, edu_email, edu_gender, edu_dob) 
            values (?,?,?,?,?,?,?,?)', [$edu_name, $edu_IC, $edu_year, $edu_age, $edu_address, $edu_email, $edu_gender, $edu_dob]);

            $current_id = DB::table('educator_list')->where('edu_IC', $edu_IC)->pluck('id')->first();
            $new_id = now()->year . (int)$current_id;

            if ($new_id != NULL) {
                DB::table('educator_list')->where('edu_IC', $edu_IC)->update(['edu_id' => 'EDU_' . $new_id]);

                $user_name =  DB::table('educator_list')->where('edu_IC', $edu_IC)->pluck('edu_id')->first();
                $user_password =  Hash::make($edu_IC);
                $user_role = 1;

                DB::select('insert into user_login_details (user_name, user_password, user_role, name, email) values (?,?,?,?,?)', [
                    $user_name, $user_password,
                    $user_role, $edu_name, $edu_email
                ]);

                return redirect('adminAddEducator')->with('pass_status', 'New Educator registered successfully');
            }
        }
    }

    public function deleteEducator(Request $request)
    {
        $delete_edu = $request->input('delete_edu');

        DB::table('educator_list')->where('edu_id', [$delete_edu])->delete();
        return redirect('adminAddEducator')->with('delete_status', 'Educator Removed successfully! ');
    }

    public function editEducatorRoute(Request $request)
    {
        $edu_id = $request->input('edu_id');

        $educator = DB::table('educator_list')->where('edu_id', $edu_id)->get();
        return view('admin/adminEditEducator', compact('educator'));
    }

    public function editEducator(Request $request)
    {
        $edu_id = $request->input('edu_id');
        $edu_name = $request->input('edu_name');
        $edu_year = $request->input('edu_year');
        $edu_IC = $request->input('edu_IC');
        $edu_age = $request->input('edu_age');
        $edu_address = $request->input('edu_address');
        $edu_email = $request->input('edu_email');
        $edu_gender = $request->input('edu_gender');
        $edu_dob = $request->input('edu_dob');

        $this->validate($request, [
            'edu_name' => 'required',
            'edu_IC' => 'required',
            'edu_year' => 'required|integer|between:0,60',
            'edu_age' => 'required|integer|between:18,50',
            'edu_address' => 'required',
            'edu_email' => 'required',
            'edu_gender' => 'required',
            'edu_dob' => 'required',
        ]);

        $data = array(
            "edu_name" => $edu_name,
            "edu_IC" => $edu_IC,
            "edu_year" => $edu_year,
            "edu_age" => $edu_age,
            "edu_address" => $edu_address,
            "edu_email" => $edu_email,
            "edu_gender" => $edu_gender,
            "edu_dob" => $edu_dob,
        );

        try {
            DB::table('educator_list')->where('edu_id', $edu_id)->update($data);
            return redirect('adminAddEducator')->with('pass_status', 'Educator Information Updated Successfully! ');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();
            if ($errorCode == 1062) {
            }
        }
        return redirect('adminAddEducator')->with('error_status', 'Educator Information Updated Failed, Duplicated Information Found! ');
    }

    public function filterEducator(Request $request)
    {
        $edu_id = $request->input('edu_id');

        $educators = DB::table('educator_list')->where('edu_id', [$edu_id])->get();  //To fetch the filtered data from database 
        $count = count($educators);

        if ($count == 1) {
            return view('admin/adminAddEducator', compact('educators'));
        }
        if ($count == 0) {
            return redirect('adminAddEducator')->with('error_status', 'Invalid Educator ID! ');
        }
    }
}
