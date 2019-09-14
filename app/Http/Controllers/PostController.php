<?php

namespace App\Http\Controllers;

use App\like;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function create(Request $request, $id)
	{
		Post::create([

			'title'   => $request->title,
			'body'    => $request->body,
			'user_id' => $id,
		]);

		return back()->with('status','post in created :)');
	}

	public function index()
	{
		$posts = Post::all();

		return view('home', compact('posts'));
	}

	public function update(Request $request, $id)
	{
		$post = Post::find($id);

		$post->update([
			'title' => $request->title,
			'body'  => $request->body,
		]);

		return back();
	}

	public function delete($id)
	{
		$post = Post::find($id);
		$post->delete();

		return back();
	}

	public function voted($post, $vote)
	{
		$post  = Post::find($post);
		$voted = $post->likes()->where('user_id', auth()->user()->id)->first();
		if (isset($voted->id)) {
			$voted->update(['like' => $vote]);
		} else
			$post->likes()->create(['user_id' => auth()->user()->id, 'like' => $vote]);

		return back();
	}

	public function favorite($id)
	{
	    auth()->user()->favorites()->create([
	    	'post_id' => $id
	    ]);

	    return back();
	}

	public function unfavorite($id)
	{
		$post =	auth()->user()->favorites()->where('post_id' ,$id)->delete();

		return back();
	}

	public function isFavorited($id)
	{
		 $favorite =auth()->user()->favorites()->where('post_id' ,$id)->first();

		if (isset($favorite->id)) {
			return 1;
		} else
			return 0;
	}

	public function showfavorite()
	{
	  $favorites =   auth()->user()->favorites;
		$list =array();
	  foreach ($favorites as $favorite){
	  	$list [] = $favorite->post_id;
	  }
		$posts = Post::find($list);

	  return view('favorite-post',compact('posts'));
	}

	public function isLike($id)
	{

		$post  = Post::find($id);
		$like = $post->likes()->where('user_id', auth()->user()->id)->first();

		if (isset($like->id)) {
			return $like->like;
		} else
			return 0;
	}


}
