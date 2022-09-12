<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PostsApiController extends Controller
{
    // get all news
    public function index() {
		return Post::all();
	}

    // store news
    public function store(Request $request) {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $image_path = $request->file('image')->store('image', 'public');


        $success = $data = Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'source' => request('source'),
            'image' => $image_path
        ]);

        return response($success, Response::HTTP_CREATED);
	}

    // update news
    public function update(Post $post) {
		request()->validate([
            'title' => 'required',
            'content' => 'required',
            'source' => 'required',
            'image' => 'required'
            ]);
        
            $success = $post->update([
                'title'=> request('title'),
                'content'=> request('content'),
                'source'=> request('source'),
                'image' => request('image')
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
