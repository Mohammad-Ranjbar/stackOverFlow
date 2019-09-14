<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'body', 'user_id'];
	protected $appends = ['active'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function Replies()
	{
		return $this->hasMany('App\Reply');
	}
	public function likes()
	{
	    return $this->morphMany('App\Like', 'likeable');
	}

	public function getActiveAttribute()
	{
		$like = $this->likes()->where('user_id', auth()->user()->id)->first();
		if (isset($like->id)) {
			return $like->like;
		} else
			return 0;
	}

}
