<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPage extends Model
{
	protected $table = 'banner_page';
	public $timestamps = false;

	public function scopeGetByPageId($query, $pageId, $bannerSizeId, $take = null, $multi = false)
	{
		return $query->where([
			['page_id', $pageId],
			['banner_size_id', $bannerSizeId]
		])->inRandomOrder();
	}
}
