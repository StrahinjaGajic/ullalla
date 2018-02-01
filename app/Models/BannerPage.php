<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPage extends Model
{
	protected $table = 'banner_page';

	public function scopeGetByPageId($query, $pageId, $bannerSizeId, $take = null, $multi = false)
	{
		$banners = $query->where('page_id', $pageId)->where('banner_size_id', $bannerSizeId)->inRandomOrder();

		if ($multi === true) {
			if ($take !== null) {
				return $banners->take($take)->get();
			} else {
				return $banners->get();
			}
		} else {
			return $banners->first();
		}
	}
}
