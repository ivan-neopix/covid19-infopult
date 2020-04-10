<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\TagsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::redirect('/', 'login');

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');

    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('categories', CategoriesController::class);

    Route::resource('tags', TagsController::class);

    Route::resource('posts', PostsController::class)
        ->only('index', 'update', 'edit');

    Route::patch("/posts/{post}/approve", [PostsController::class, 'approve'])->name('posts.approve');
    Route::delete("/posts/{post}/deny", [PostsController::class, 'deny'])->name('posts.deny');
});
