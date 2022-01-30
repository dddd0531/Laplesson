<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Comment;
use App\Models\Post;

class CommentsController extends Controller
{
    //
	public function store(Request $request, $postId){
		$this->validate($request,[
			'body' => 'required'
		]);

		$comment = new Comment(['body' => $request->body]);
		$post = Post::findOrFail($postId);
		$post->comments()->save($comment);

		return redirect()
			->action('PostsController@show', $post->id);
	}

	public function destroy($postId, $commentId){
		$post = Post::findOrFail($postId);
		$post->comments()->findOrFail($commentId)->delete();

		return redirect()
			->action('PostsController@show', $post->id);

	}
}
