<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class adminLogoutController extends Controller
{
    public function logout(Request $request){

        Session::flush();
        return redirect('/adminLogin')->with('alert', 'Logged out successfully !');

    }

    public function invalidSession(Request $request){

        return redirect('/adminInvalidSession');

    }
}
