<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = false;

    public function banner_sizes()
    {
        return $this->belongsToMany('App\Models\BannerSize', 'page_banner_size')->withPivot('price_without_banner', 'price_with_banner');
    }

    public function banners()
    {
        return $this->belongsToMany('App\Models\Banner', 'page_banner');
    }
}
