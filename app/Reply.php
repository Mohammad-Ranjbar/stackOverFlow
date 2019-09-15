<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $fillable = ['body', 'post_id', 'bestAnswer',  'user_id'];
	protected $appends = ['active'];
	public function post()
	{
		return $this->belongsTo('App\Post');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
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
		}
		else
			return 0;
	}
}
