<?php

use App\Http\Controllers\AuthComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rest-api comments
Route::get('v1/comments', [CommentController::class, 'index']);
Route::post('v1/comments', [CommentController::class, 'store']);
Route::get('v1/comments/{comment}', [CommentController::class, 'show']);
Route::put('v1/comments/{comment}', [CommentController::class, 'update']);
Route::delete('v1/comments/{comment}', [CommentController::class, 'destroy']);


Route::get('v1/comments/user/{id}', [CommentController::class, 'getCommentsByUser']);


Route::post('v1/login', [AuthComments::class, 'login']);
