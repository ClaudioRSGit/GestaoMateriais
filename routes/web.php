<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::post('/posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/messages/{id}/toggle', [MessageController::class, 'toggleRead'])->name('messages.toggle');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('admin');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/toggle', [UserController::class, 'toggleActive'])->name('admin.users.toggle');
    Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole'])->name('admin.users.role');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
});
