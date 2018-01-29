<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    public function banner_sizes()
    {
        return $this->belongsToMany('App\Models\BannerSize', 'page_banner_size')->withPivot('price_per_day', 'price_per_week', 'price_per_month');
    }

    public function banners()
    {
        return $this->belongsToMany('App\Models\Banner', 'banner_page', 'banner_id', 'page_id', 'banner_size_id');
    }
}
