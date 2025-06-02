<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
Route::post('/posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/messages/{id}/toggle', [MessageController::class, 'toggleRead'])->name('messages.toggle');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
