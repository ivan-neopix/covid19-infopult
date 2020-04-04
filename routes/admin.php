<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PostsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');
});

Route::middleware('auth:admin')->group(function () {
    Route::resource('posts', PostsController::class);
});
