<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerSize extends Model
{
    public $timestamps = false;

    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'page_banner_size')->withPivot('price_per_day', 'price_per_week', 'price_per_month');
    }
}
