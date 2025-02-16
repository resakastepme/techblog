<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::get('/register', [AuthController::class, 'indexRegister']);
Route::get('/register-check-email', [AuthController::class, 'registerCheckEmail']);
Route::post('/register-check', [AuthController::class, 'registerCheck']);
Route::post('/login-check', [AuthController::class, 'loginCheck']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/create', [PostController::class, 'index']);
Route::post('/store-post', [PostController::class, 'store']);

Route::get('/{id}/view', [PostController::class, 'viewPost']);

Route::post('/post-comment', [CommentController::class, 'store']);
Route::post('/post-reply-comment', [CommentController::class, 'storeReply']);

Route::get('/{id}/edit', [PostController::class, 'edit']);
Route::post('/store-edit-post', [PostController::class, 'updatePost']);

Route::get('/post-delete', [PostController::class, 'destroy']);

Route::get('/search', [SearchController::class, 'index']);
Route::get('/search-post', [SearchController::class, 'search']);

Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
});
