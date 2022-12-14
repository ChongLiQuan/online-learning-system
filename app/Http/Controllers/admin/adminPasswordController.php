<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class adminPasswordController extends Controller
{
    public function adminUpdatePassword(Request $request)
    {
        $user_name = $request->input('user_name');
        $new_password = $request->input('new_password');

        $this->validate($request, [
            'user_name' => 'required',
            'new_password' => 'required',
        ]);


        $data = array(
            "user_name" => $user_name,
            'user_password' => hash::make($new_password),
        );

        $checkUser = DB::select('select * from user_login_details where user_name = ?', [$user_name]);

        if ($checkUser != null) {
            DB::table('user_login_details')->where('user_name', $user_name)->update($data);
            return redirect('adminUpdatePassword')->with('pass_status', 'User Password Has Been Updated Successfully!');
        } else {
            return redirect('adminUpdatePassword')->with('error_status', 'User not found! Please try with a valid username.');
        }
    }
}
