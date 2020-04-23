<?php

use App\Http\Controllers\Web\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index'])->name('homepage');
Route::get('/offline', [PostsController::class, 'offline'])->name('offline');
Route::get('/dodaj-objavu', [PostsController::class, 'create'])->name('posts.create');
Route::post('/dodaj-objavu', [PostsController::class, 'store'])->name('posts.store');

