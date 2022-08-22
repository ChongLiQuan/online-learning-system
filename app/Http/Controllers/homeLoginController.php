<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class homeLoginController extends Controller
{
    public function userLogin (Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
    
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
            ]);

            $result = DB::select('select * from user_login_details where user_name = ? AND user_password = ?', [$username, $password]);
        
        if($result != null){

            $user_role = DB::select('select user_role from user_login_details where username = ? ', [$username]);

            session()->start();
            Session::put('username', $username);         
            Session::put('role', $user_role);            
   
            return redirect('homepage');
        }else{
            return redirect('/')->with('status', 'Incorrect username or password !');
        }
    }
}
