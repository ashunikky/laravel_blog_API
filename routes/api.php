<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
/*
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::get('/user/{id}',[UserController::class,'showUser']);

Route::apiResource('/blog', BlogController::class);

Route::get('blog/{blogId}/comments', [CommentController::class, 'getComments']);
Route::post('blog/{blogId}/comments', [CommentController::class, 'saveComment']);
Route::put('comments/{commentID}', [CommentController::class, 'updateComment']);
Route::delete('comments/{commentID}', [CommentController::class, 'deleteComment']);

Route::post('/user/{user}/follow', [FollowController::class,'follow']);
Route::post('/user/{user}/unfollow', [FollowController::class,'unfollow']);






