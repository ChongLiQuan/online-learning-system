<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\adminLogoutController;
use App\Http\Controllers\adminFormController;
use App\Http\Controllers\adminClassController;

//General both party page
Route::get('/', function () { return view('welcome');});

//Admin pages route
//Admin login and logout route
Route::get('/adminLogin', function () { return view('admin/adminLogin');});

Route::post('/adminLogin', [App\Http\Controllers\adminLoginController::class, 'validateLogin']);

Route::get('/adminLogout', [App\Http\Controllers\adminLogoutController::class, 'logout']);

//Admin homepage route and check valid session 
Route::get('/adminHomepage', function () { 
    if (Session::get('username') == NULL){
        return view('admin/adminInvalidSession');
    }else{
        return view('admin/adminHomepage');
    }
});

//Admin add form route
Route::get('/adminAddForm', function () { return view('admin/adminAddForm');});
Route::post('/adminAddForm', [App\Http\Controllers\adminFormController::class, 'addForm']);
Route::get('/adminAddForm', function () {
    $forms = DB::table('form_list')->get();
    return view('admin/adminAddForm',compact('forms'));
});

//Admin delete form route
Route::post('/', [App\Http\Controllers\adminFormController::class, 'deleteForm'])->name('deleteForm');

//Admin add class route
Route::get('/adminAddClass', function () { return view('admin/adminAddClass');});
Route::post('/adminAddClass', [App\Http\Controllers\adminClassController::class, 'addClass']);
Route::get('/adminAddClass', function () { 
    $forms = DB::table('form_list')->get();
    return view('admin/adminAddClass',compact('forms'));
});

//Student pages route
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
