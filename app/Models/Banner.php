<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	public function local()
	{
		return $this->belongsTo('App\Models\Local');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function pages()
	{
		return $this->belongsToMany('App\Models\Page', 'page_banner');
	}
}