<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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
Route::get('/posts', function() {
    return Post::all();
});

// post news 
Route::post('/posts', function() {

    request()->validate([
		'title' => 'required',
		'content' => 'required',
        'source' => 'required'
	]);

    return Post::create([
    'title' => request('title'),
    'content' => request('content'),
    'source' => request('source')
    ]);
});

// update news
Route::put('/posts/{post}', function(Post $post) {
    request()->validate([
    'title' => 'required',
    'content' => 'required',
    'source' => 'required'
    ]);

    $success = $post->update([
        'title'=> request('title'),
        'content'=> request('content'),
        'source'=> request('source')
    ]);

    return [
		'success' => $success,
        'data' => $post
	];
});

// delete news 
Route::delete('/posts/{post}', function(Post $post) {
    $success = $post->delete();

    return [
        'success' => $success
    ];

});