<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\adminLogoutController;
use App\Http\Controllers\adminFormController;
use App\Http\Controllers\adminClassController;
use App\Http\Controllers\adminSubjectController;
use App\Http\Controllers\adminEducatorController;
use App\Http\Controllers\adminStudentController;

//General both party page
Route::get('/', function () {
    return view('welcome');
});

//Admin pages route
//Admin login and logout route and check invalid session
Route::get('/adminLogin', function () {
    return view('admin/adminLogin');
});
Route::post('/adminLogin', [App\Http\Controllers\adminLoginController::class, 'validateLogin']);
Route::get('/adminLogout', [App\Http\Controllers\adminLogoutController::class, 'logout']);

//Admin homepage route and check valid session 
Route::get('/adminHomepage', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminHomepage');
    }
});

//Admin add form route and check invalid session
Route::get('/adminAddForm', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        return view('admin/adminAddForm', compact('forms'));
    }
});

Route::post('/adminAddForm', [App\Http\Controllers\adminFormController::class, 'addForm'])->name('addForm');

Route::get('/adminEditForm', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminEditForm', compact('educators'));
    }
});
Route::post('/editFormRoute', [App\Http\Controllers\adminFormController::class, 'editFormRoute'])->name('editFormRoute');
Route::post('/editForm', [App\Http\Controllers\adminFormController::class, 'editForm'])->name('editForm');
Route::post('/', [App\Http\Controllers\adminFormController::class, 'deleteForm'])->name('deleteForm');

//Admin add class route
Route::get('/adminAddClass', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->get();
        return view('admin/adminAddClass', compact('forms', 'classes'));
    }
});
Route::get('/adminEditClass', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->get();
        return view('admin/adminEditClass', compact('forms', 'classes'));
    }
});
Route::post('/adminAddClass', [App\Http\Controllers\adminClassController::class, 'addClass'])->name("addClass");
Route::post('/editClassRoute', [App\Http\Controllers\adminClassController::class, 'editClassRoute'])->name("editClassRoute");
Route::post('/editClass', [App\Http\Controllers\adminClassController::class, 'editClass'])->name("editClass");
Route::post('/delete', [App\Http\Controllers\adminClassController::class, 'deleteClass'])->name("deleteClass");
Route::post('/filter', [App\Http\Controllers\adminClassController::class, 'filterClass'])->name("filterClass");

//Admin add subject route
Route::get('/adminAddSubject', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $subjects = DB::table('subject_list')->orderBy('form_id')->get();
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $classes = DB::table('class_list')->orderBy('form_id')->get();
        return view('admin/adminAddSubject', compact('forms', 'classes', 'subjects'));
    }
});
Route::get('/adminEditSubject', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $forms = DB::table('form_list')->orderBy('form_level')->get();
        $subjects = DB::table('subject_list')->orderBy('form_id')->get();
        return view('admin/adminEditSubject', compact('forms', 'subjects'));
    }
});
Route::post('/addSubject', [App\Http\Controllers\adminSubjectController::class, 'addSubject'])->name("addSubject");
Route::post('/editSubjectRoute', [App\Http\Controllers\adminSubjectController::class, 'editSubjectRoute'])->name("editSubjectRoute");
Route::post('/editSubject', [App\Http\Controllers\adminSubjectController::class, 'editSubject'])->name("editSubject");
Route::post('/deleteSubject', [App\Http\Controllers\adminSubjectController::class, 'deleteSubject'])->name("deleteSubject");
Route::post('/filterSubject', [App\Http\Controllers\adminSubjectController::class, 'filterSubject'])->name("filterSubject");

//Admin add educator route
Route::get('/adminAddEducator', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $educators = DB::table('educator_list')->orderBy('edu_id')->get();
        return view('admin/adminAddEducator', compact('educators'));
    }
});
Route::post('/addEducator', [App\Http\Controllers\adminEducatorController::class, 'addEducator'])->name("addEducator");
Route::post('/deleteEducator', [App\Http\Controllers\adminEducatorController::class, 'deleteEducator'])->name("deleteEducator");

Route::get('/adminEditEducator', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminEditEducator', compact('educators'));
    }
});
Route::post('/editEducatorRoute', [App\Http\Controllers\adminEducatorController::class, 'editEducatorRoute'])->name("editEducatorRoute");
Route::post('/editEducator', [App\Http\Controllers\adminEducatorController::class, 'editEducator'])->name("editEducator");

//Admin add student route
Route::get('/adminAddStudent', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $students = DB::table('student_list')->orderBy('student_id')->get();
        return view('admin/adminAddStudent', compact('students'));
    }
});
Route::get('/adminEditStudent', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $students = DB::table('student_list')->orderBy('student_id')->get();
        return view('admin/adminEditStudent', compact('students'));
    }
});
Route::post('/addStudent', [App\Http\Controllers\adminStudentController::class, 'addStudent'])->name("addStudent");
Route::post('/editStudentRoute', [App\Http\Controllers\adminStudentController::class, 'editStudentRoute'])->name("editStudentRoute");
Route::post('/editStudent', [App\Http\Controllers\adminStudentController::class, 'editStudent'])->name("editStudent");
Route::post('/deleteStudent', [App\Http\Controllers\adminStudentController::class, 'deleteStudent'])->name("deleteStudent");

//Student pages route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
