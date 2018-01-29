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
		return $this->belongsToMany('App\Models\Page', 'banner_page', 'banner_id', 'page_id', 'banner_size_id');
	}
}