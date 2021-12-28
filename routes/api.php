<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts',[\App\Http\Controllers\Api\PostController::class,'index']);
Route::get('/post/show/{id}',[\App\Http\Controllers\Api\PostController::class,'show']);
Route::get('/posts/latest',[\App\Http\Controllers\Api\PostController::class,'GetLatestPosts']);
Route::get('/posts/most',[\App\Http\Controllers\Api\PostController::class,'GetMostReaded']);

Route::get('/team',\App\Http\Controllers\Api\TeamController::class);

Route::get('/categories',[\App\Http\Controllers\Api\CategoryController::class,'index']);
Route::get('/category/show/{id}',[\App\Http\Controllers\Api\CategoryController::class,'show']);

Route::post('/comment/post/{id}',[\App\Http\Controllers\Api\CommentController::class,'store']);
