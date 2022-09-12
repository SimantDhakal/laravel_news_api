<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\PostsApiController;

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

// get all news
Route::get('/posts', [PostsApiController::class, 'index']);

// post news 
Route::post('/posts', [PostsApiController::class, 'store']);

// update news
Route::put('/posts/{post}', [PostsApiController::class, 'update']);

// delete news 
Route::delete('/posts/{post}', [PostsApiController::class, 'destroy']);