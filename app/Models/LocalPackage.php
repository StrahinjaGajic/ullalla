<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalPackage extends Model
{
    protected $fillable = [
        'name', 'month_price', 'year_price'
    ];

    public function locals()
    {
        return $this->hasMany('App\Models\Local');
    }
}
