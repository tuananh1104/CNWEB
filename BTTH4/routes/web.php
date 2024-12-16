<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;

// Route cho trang chủ, có thể chuyển hướng tới trang quản lý vấn đề
Route::get('/', function () {
    return redirect()->route('issues.index');
});

// Route cho các chức năng CRUD (Create, Read, Update, Delete) của vấn đề
Route::resource('issues', IssuesController::class);
