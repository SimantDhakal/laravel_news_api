<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsApiController extends Controller
{
    // get all news
    public function index() {
		return Post::all();
	}

    // store news
    public function store() {
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
	}

    // update news
    public function update(Post $post) {
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
	}

    // delete news
    public function destroy(Post $post) {
		$success = $post->delete();

        return [
            'success' => $success
        ];
	}
}
