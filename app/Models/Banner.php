<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	public function bannerable()
	{
		return $this->morphTo();
	}

	public function pages()
	{
		return $this->belongsToMany('App\Models\Page', 'banner_page', 'banner_id', 'page_id', 'banner_size_id');
	}
}