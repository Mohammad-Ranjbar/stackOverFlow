<?php

namespace App\Http\Controllers;

use App\Policies\ReplyPolicy;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
	public function index($id)
	{
		$post    = Post::find($id);
		$replies = $post->replies;

		return view('show-reply', compact('replies', 'id', 'post'));
	}

	public function create(Request $request, $id, $user)
	{
		Reply::create([
			'body'    => $request->body,
			'post_id' => $id,
			'user_id' => $user,
		]);

		return back();
	}

	public function update(Request $request,Reply $reply)
	{


		// $reply = Reply::find($id);
		$this->authorize('update',$reply);
		$reply->update([
			'body' => $request->body,
		]);
	}

	public function delete($id)
	{
		$reply = Reply::find($id);
		$reply->delete();

		return back();
	}

	public function bestAnswer(Request $request, $id)
	{
		DB::table('replies')
		  ->where('id', $id)
		  ->update(['bestAnswer' => 1]);
		DB::table('replies')
		  ->where('id', '!=', $id)
		  ->update(['bestAnswer' => 0]);

		return back();
	}


	public function voted($reply,$vote)
	{

		$reply = Reply::find($reply);
		$voted = $reply->likes()->where('user_id',auth()->user()->id)->first();
		if (isset($voted->id)) {
			$voted->update(['like' => $vote]);
		}
		else
			$reply->likes()->create(['user_id' => auth()->user()->id , 'like' =>$vote]);
		return back();
	}

}
