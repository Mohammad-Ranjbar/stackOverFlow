<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
	protected $fillable = ['user_id' , 'like'];
    public function likeable()
    {
        return $this->morphTo();
    }

}
