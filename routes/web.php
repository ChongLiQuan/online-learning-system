<?php

use Illuminate\Support\Facades\Route;

Route::get('/adminLogin', function () {
    return view('admin/adminLogin');
});
