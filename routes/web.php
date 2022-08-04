<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\adminLogoutController;
use App\Http\Controllers\adminFormController;
use App\Http\Controllers\adminClassController;
use App\Http\Controllers\adminSubjectController;

//General both party page
Route::get('/', function () { return view('welcome');});

//Admin pages route
//Admin login and logout route and check invalid session
Route::get('/adminLogin', function () { return view('admin/adminLogin');});
Route::post('/adminLogin', [App\Http\Controllers\adminLoginController::class, 'validateLogin']);
Route::get('/adminLogout', [App\Http\Controllers\adminLogoutController::class, 'logout']);

//Admin homepage route and check valid session 
Route::get('/adminHomepage', function () { 
    if(Session::get('username') == null){
        return view('admin/adminInvalidSession');
    }else{
        return view('admin/adminHomepage');
    }});

//Admin add form route and check invalid session
Route::get('/adminAddForm', function () { 
    if(Session::get('username') == null){
        return view('admin/adminInvalidSession');
    }else{
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        return view('admin/adminAddForm',compact('forms'));
    }});

Route::post('/adminAddForm', [App\Http\Controllers\adminFormController::class, 'addForm'])->name('addForm');

//Admin delete form route
Route::post('/', [App\Http\Controllers\adminFormController::class, 'deleteForm'])->name('deleteForm');

//Admin add class route
Route::get('/adminAddClass', function () { 
    if(Session::get('username') == null){
        return view('admin/adminInvalidSession');
    }else{
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->get();
        return view('admin/adminAddClass',compact('forms','classes'));
    }
});
Route::post('/adminAddClass', [App\Http\Controllers\adminClassController::class, 'addClass'])->name("addClass");
Route::post('/delete', [App\Http\Controllers\adminClassController::class, 'deleteClass'])->name("deleteClass");
Route::post('/filter', [App\Http\Controllers\adminClassController::class, 'filterClass'])->name("filterClass");

//Admin add subject route
Route::get('/adminAddSubject', function () { 
    if(Session::get('username') == null){
        return view('admin/adminInvalidSession');
    }else{
        $subjects = DB::table('subject_list')->orderBy('form_level')->get();
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->orderBy('form_name')->get();
        return view('admin/adminAddSubject',compact('forms','classes','subjects'));
    }
});
Route::post('/addSubject', [App\Http\Controllers\adminSubjectController::class, 'addSubject'])->name("addSubject");
Route::post('/filterSubject', [App\Http\Controllers\adminSubjectController::class, 'filterSubject'])->name("filterSubject");

//Admin add lecturer route
Route::get('/adminAddEducator', function () { 
    if(Session::get('username') == null){
        return view('admin/adminInvalidSession');
    }else{
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->orderBy('form_name')->get();
        return view('admin/adminAddEducator',compact('forms','classes'));
    }
});

//Student pages route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
