<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class homeLoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        //decrypted password
        $password_database =  DB::table('user_login_details')->where('user_name', $username)->pluck('user_password')->first();
        $hash_password = Hash::make($password);

        //$result = DB::select('select * from user_login_details where user_name = ? AND user_password = ?', [$username, $hash_password]);
        $user_role =  DB::table('user_login_details')->where('user_name', $username)->pluck('user_role')->first();

        if (Hash::check($password, $password_database)) {

            session()->start();
            Session::put('username', $username);
            Session::put('user_role', $user_role);

            if ($user_role == 1) {
                return redirect('/educatorHomepage');
            }
            if ($user_role == 2) {
                $user_class =  DB::table('student_list')->where('student_id', $username)->pluck('student_class')->first();
                Session::put('user_class', $user_class);

                return redirect('/studentHomepage');
            }
            
        } else {
            return redirect('/userLogin')->with('status', 'Incorrect username or password !');
        }
    }

    public function logout(Request $request){

        Session::flush();
        return redirect('/userLogin')->with('alert', 'Logged out successfully !');

    }
}
