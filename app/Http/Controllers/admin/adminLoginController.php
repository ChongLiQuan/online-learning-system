<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class adminLoginController extends Controller
{
    public function adminHomepage()
    {
        if (Session::get('username') == null) {
            return view('admin/adminInvalidSession');
        } else {
            return view('admin/adminHomepage');
        }
    }

    public function adminLoginHomepage ()
    {
        return view('admin/adminLogin');
    }

    public function validateLogin (Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $result = DB::select('select * from admin_list where admin_username = ? AND admin_password = ?', [$username, $password]);

        if ($result != null) {
            session()->start();
            Session::put('username', $username);
            return redirect('adminAddForm');
        } else {
            return redirect('adminLogin')->with('status', 'Incorrect username or password !');
        }
    }
}
