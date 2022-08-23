<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class adminLoginController extends Controller
{
    public function validateLogin(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
    
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
            ]);

            $result = DB::select('select * from admin_list where username = ? AND password = ?', [$username, $password]);
        
        if($result != null){
            session()->start();
            Session::put('username', $username);            
            return redirect('adminAddForm');
        }else{
            return redirect('adminLogin')->with('status', 'Incorrect username or password !');
        }
    }
}
