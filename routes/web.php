<?php

use Illuminate\Support\Facades\Route;

//General both party page
Route::get('/userLogin', function () {
    return view('userLogin');
});
Route::post('/userLogin', [App\Http\Controllers\homeLoginController::class, 'userLogin'])->name("userLogin");

//Admin pages route
//Admin login and logout route and check invalid session
Route::get('/adminLogin', function () {
    return view('admin/adminLogin');
});
Route::post('/adminLogin', [App\Http\Controllers\admin\adminLoginController::class, 'validateLogin']);
Route::get('/adminLogout', [App\Http\Controllers\admin\adminLogoutController::class, 'logout']);

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

Route::post('/adminAddForm', [App\Http\Controllers\admin\adminFormController::class, 'addForm'])->name('addForm');

Route::get('/adminEditForm', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminEditForm', compact('educators'));
    }
});
Route::post('/editFormRoute', [App\Http\Controllers\admin\adminFormController::class, 'editFormRoute'])->name('editFormRoute');
Route::post('/editForm', [App\Http\Controllers\admin\adminFormController::class, 'editForm'])->name('editForm');
Route::post('/deleteForm', [App\Http\Controllers\admin\adminFormController::class, 'deleteForm'])->name('deleteForm');

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
Route::post('/adminAddClass', [App\Http\Controllers\admin\adminClassController::class, 'addClass'])->name("addClass");
Route::post('/editClassRoute', [App\Http\Controllers\admin\adminClassController::class, 'editClassRoute'])->name("editClassRoute");
Route::post('/editClass', [App\Http\Controllers\admin\adminClassController::class, 'editClass'])->name("editClass");
Route::post('/delete', [App\Http\Controllers\admin\adminClassController::class, 'deleteClass'])->name("deleteClass");
Route::post('/filter', [App\Http\Controllers\admin\adminClassController::class, 'filterClass'])->name("filterClass");

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
Route::post('/addSubject', [App\Http\Controllers\admin\adminSubjectController::class, 'addSubject'])->name("addSubject");
Route::post('/editSubjectRoute', [App\Http\Controllers\admin\adminSubjectController::class, 'editSubjectRoute'])->name("editSubjectRoute");
Route::post('/editSubject', [App\Http\Controllers\admin\adminSubjectController::class, 'editSubject'])->name("editSubject");
Route::post('/deleteSubject', [App\Http\Controllers\admin\adminSubjectController::class, 'deleteSubject'])->name("deleteSubject");
Route::post('/filterSubject', [App\Http\Controllers\admin\adminSubjectController::class, 'filterSubject'])->name("filterSubject");

//Admin add educator route
Route::get('/adminAddEducator', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $educators = DB::table('educator_list')->orderBy('edu_id')->get();
        return view('admin/adminAddEducator', compact('educators'));
    }
});
Route::post('/addEducator', [App\Http\Controllers\admin\adminEducatorController::class, 'addEducator'])->name("addEducator");
Route::post('/deleteEducator', [App\Http\Controllers\admin\adminEducatorController::class, 'deleteEducator'])->name("deleteEducator");
Route::post('/filterEducator', [App\Http\Controllers\admin\adminEducatorController::class, 'filterEducator'])->name("filterEducator");

Route::get('/adminEditEducator', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminEditEducator', compact('educators'));
    }
});
Route::post('/editEducatorRoute', [App\Http\Controllers\admin\adminEducatorController::class, 'editEducatorRoute'])->name("editEducatorRoute");
Route::post('/editEducator', [App\Http\Controllers\admin\adminEducatorController::class, 'editEducator'])->name("editEducator");

//Admin add student route
Route::get('/adminAddStudent', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $students = DB::table('student_list')->orderBy('student_id')->get();
        $class = DB::table('class_list')->orderBy('class_id')->get();
        return view('admin/adminAddStudent', compact('students', 'class'));
    }
});
Route::get('/adminEditStudent', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $students = DB::table('student_list')->orderBy('student_id')->get();
        $class = DB::table('class_list')->orderBy('class_id')->get();
        return view('admin/adminAddStudent', compact('students', 'class'));
    }
});
Route::post('/addStudent', [App\Http\Controllers\admin\adminStudentController::class, 'addStudent'])->name("addStudent");
Route::post('/editStudentRoute', [App\Http\Controllers\admin\adminStudentController::class, 'editStudentRoute'])->name("editStudentRoute");
Route::post('/editStudent', [App\Http\Controllers\admin\adminStudentController::class, 'editStudent'])->name("editStudent");
Route::post('/deleteStudent', [App\Http\Controllers\admin\adminStudentController::class, 'deleteStudent'])->name("deleteStudent");
Route::post('/filterStudent', [App\Http\Controllers\admin\adminStudentController::class, 'filterStudent'])->name("filterStudent");

//Admin Find user and Update User Password 
Route::get('/adminUpdatePassword', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        return view('admin/adminUpdatePassword');
    }
});
Route::post('/updatePassword', [App\Http\Controllers\admin\adminPasswordController::class, 'updatePassword'])->name("updatePassword");

//Admin Assign Educator to a Subject Page
Route::get('/adminAssignSubject', function () {
    if (Session::get('username') == null) {
        return view('admin/adminInvalidSession');
    } else {
        $educators = DB::table('educator_list')->orderBy('edu_id')->get();
        $class = DB::table('class_list')->orderBy('class_id')->get();
        $subjects = DB::table('subject_list')->orderBy('form_id')->get();
        $classSubject = DB::table('class_subject_list')->orderBy('id')->get();
        return view('admin/adminAssignSubject', compact('educators', 'class', 'subjects', 'classSubject'));
    }
});
Route::post('/assignSubject', [App\Http\Controllers\admin\adminAssignSubjectController::class, 'assignSubject'])->name("assignSubject");
Route::post('/deleteAssign', [App\Http\Controllers\admin\adminAssignSubjectController::class, 'deleteAssign'])->name("deleteAssign");

//Educator Pages Route
Route::get('/educatorHomepage', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $subjects = DB::table('class_subject_list')->where('educator_id', $username)->orderBy('class_subject_id')->get();
        $announcement = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('annouce_id', 'DESC')->get();
        return view('educator/educatorHomepage', compact('subjects', 'announcement'));
    }
});

Route::get('/courseHome/{id}', function ($id) {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $subjects = DB::table('class_subject_list')->where('class_subject_id', $id)->get('subject_code');
        $class_name = DB::table('class_subject_list')->where('class_subject_id', $id)->pluck('class_name')->first();
        $folders = DB::table('subject_folder_list')->where('class_subject_id', $id)->where('subject_subFolder', 0)->get();
        //Display All Information According t2o the Specific Course Code

        return view('courseHome', compact('subjects', 'folders'))->with('class_name', $class_name);
    }
})->name('courseHome');

Route::get('/logout', [App\Http\Controllers\homeLoginController::class, 'logout']);

Route::get('/educatorAddAnnouncement', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $subjects = DB::table('class_subject_list')->where('educator_id', $username)->groupBy('subject_code')->get();
        $classes = DB::table('class_subject_list')->where('educator_id', $username)->groupBy('class_name')->get();
        return view('educator/educatorAddAnnouncement', compact('subjects', 'classes'));
    }
});

Route::post('/uploadImage', [App\Http\Controllers\educator\educatorAnnounementController::class, 'uploadImage'])->name('uploadImage');
Route::post('/addAnnouncement', [App\Http\Controllers\educator\educatorAnnouncementController::class, 'addAnnouncement'])->name('addAnnouncement');

Route::get('/educatorAnnouncement', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $list = DB::table('announcement_list')->where('annouce_educator', $username)->orderBy('created_at', 'DESC')->get();
        return view('educator/educatorAnnouncement', compact('list'));
    }
});

Route::get('/educatorEditAnnouncement', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $subjects = DB::table('class_subject_list')->where('educator_id', $username)->groupBy('subject_code')->get();
        $classes = DB::table('class_subject_list')->where('educator_id', $username)->groupBy('class_name')->get();
        return view('educator/educatorEditAnnouncement', compact('subjects', 'classes'));
    }
});

Route::post('/editAnnouncement', [App\Http\Controllers\educator\educatorAnnouncementController::class, 'editAnnouncement'])->name('editAnnouncement');
Route::post('/deleteAnnouncement', [App\Http\Controllers\educator\educatorAnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

Route::get('/educatorAddFolder', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        //$list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->where('subject_subFolder', 0)->get();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
        return view('educator/educatorAddFolder', compact('list'));
    }
});
Route::post('/addFolder', [App\Http\Controllers\educator\educatorFolderController::class, 'addFolder'])->name('addSubjectFolder');
Route::post('/deleteFolder', [App\Http\Controllers\educator\educatorFolderController::class, 'deleteFolder'])->name('deleteFolder');

Route::get('/educatorEditFolder', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->where('subject_subFolder', 0)->get();
        return view('educator/educatorEditFolder', compact('list'));
    }
});
Route::post('/editFolder', [App\Http\Controllers\educator\educatorFolderController::class, 'editFolder'])->name('editFolder');

Route::get('/courseContent/{subject_folder_id}', function ($subject_folder_id) {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $subjects = DB::table('class_subject_list')->where('class_subject_id', $subject_folder_id)->get('subject_code');
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();

        $folders = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->where('subject_subFolder', $subject_folder_id)->get();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->where('subject_subFolder', $subject_folder_id)->get();
        $content_list = DB::table('folder_content_list')->where('subject_folder_id', $subject_folder_id)->get();
        $discussion = DB::table('discussion_list')->where('subject_folder_id', $subject_folder_id)->get();
        return view('courseContent', compact('list', 'subjects', 'folders', 'content_list', 'discussion'));
    }
})->name('courseContent');

Route::get('/educatorAddContent', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
        return view('educator/educatorAddContent', compact('list'));
    }
});

Route::get('/educatorEditContent', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
        return view('educator/educatorEditContent', compact('list'));
    }
});
Route::post('/editContent', [App\Http\Controllers\educator\educatorContentController::class, 'editContent'])->name('editContent');
Route::post('/addContent', [App\Http\Controllers\educator\educatorContentController::class, 'addContent'])->name('addContent');
Route::post('/deleteContent', [App\Http\Controllers\educator\educatorContentController::class, 'deleteContent'])->name('deleteContent');

Route::get('/educatorAddDiscussion', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
        return view('educator/educatorAddDiscussion', compact('list'));
    }
});

Route::get('/educatorEditDiscussion', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $class_subject_id = DB::table('class_subject_list')->where('subject_code', Session::get('current_subject_code'))->where('class_name', Session::get('current_class_name'))->pluck('class_subject_id')->first();
        $list = DB::table('subject_folder_list')->where('class_subject_id', $class_subject_id)->get();
        return view('educator/educatorEditDiscussion', compact('list'));
    }
});

Route::post('/addDiscussion', [App\Http\Controllers\educator\educatorDiscussionController::class, 'addDiscussion'])->name('addDiscussion');
Route::post('/editDiscussion', [App\Http\Controllers\educator\educatorDiscussionController::class, 'editDiscussion'])->name('editDiscussion');
Route::post('/deleteDiscussion', [App\Http\Controllers\educator\educatorDiscussionController::class, 'deleteDiscussion'])->name('deleteDiscussion');

Route::get('/discussionBoard/{discussion_id}/{comment_id}', function ($discussion_id, $comment_id) {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get(('username'));
        $discussion = DB::table('discussion_list')->where('discussion_id', $discussion_id)->get();
        $comment = DB::table('comment_list')->where('discussion_id', $discussion_id)->where('sub_comment', NULL)->get();
        $filtered_comment = DB::table('comment_list')->where('comment_id', $comment_id)->get();

        $check_sub_comment = DB::table('comment_list')->where('comment_id', $comment_id)->pluck('sub_comment')->first();

        Session::put('check_sub_comment', $check_sub_comment);

        $sub_comment = DB::table('comment_list')->where('sub_comment', $comment_id)->get();

        return view('educator/educatorDiscussion', compact('discussion', 'comment', 'filtered_comment', 'sub_comment'));
    }
})->name('discussionBoard');

Route::get('/userAddComment', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        return view('userAddComment');
    }
});

Route::get('/userEditComment', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        return view('userEditComment');
    }
});

Route::post('/addDiscussionComment', [App\Http\Controllers\commentController::class, 'addComment'])->name('addComment');
Route::post('/editDiscussionComment', [App\Http\Controllers\commentController::class, 'editComment'])->name('editComment');
Route::post('/deleteComment', [App\Http\Controllers\commentController::class, 'deleteComment'])->name('deleteComment');


//Student Pages Route
Route::get('/studentHomepage', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
        $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
        $folders = DB::table('student_notes_folder_list')->where('student_name', Session::get('username'))->where('student_subFolder', 0)->orderBy('student_folder_id', 'ASC')->get();
        return view('student/studentHomepage', compact('subjects', 'announcement', 'folders'));
    }
});
Route::get('/studentAnnouncement', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $username = Session::get('username');
        $list = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
        return view('student/studentAnnouncement', compact('list'));
    }
});

Route::get('/studentAddNote', function () {
    if (Session::get('username') == null) {
        return view('userInvalidSession');
    } else {
        $subjects = DB::table('class_subject_list')->where('class_name', Session::get('user_class'))->orderBy('class_subject_id')->get();
        $announcement = DB::table('announcement_list')->where('annouce_class', Session::get('user_class'))->orderBy('created_at', 'DESC')->get();
        $folders = DB::table('student_notes_folder_list')->where('student_name', Session::get('username'))->where('student_subFolder', 0)->orderBy('student_folder_id', 'ASC')->get();
        return view('student/studentAddNote', compact('subjects', 'announcement', 'folders'));
    }
});

Route::post('/readAnnouncement', [App\Http\Controllers\student\studentAnnouncementController::class, 'readAnnouncement'])->name('readAnnouncement');
Route::post('/addStudentFolder', [App\Http\Controllers\student\studentFolderController::class, 'addStudentFolder'])->name('addStudentFolder');

