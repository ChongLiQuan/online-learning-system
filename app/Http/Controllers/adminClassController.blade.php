<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class adminClassController extends Controller
{
    public function addClass(Request $request){
        $class_name = $request->input('class_name');
        $form_name = $request->input('form_name');
    
        $result = DB::select('insert into class_list (class_name, form_name) values (?,?)' , [$class_name, $form_name]);

    }

}