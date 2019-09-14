<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
	protected $fillable = ['post_id'];

	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
