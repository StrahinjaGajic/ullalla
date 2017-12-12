<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    public $timestamps = false;

    public function users()
	{
		return $this->hasMany('App\Models\User');
	}
}
