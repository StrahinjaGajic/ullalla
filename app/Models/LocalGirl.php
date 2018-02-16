<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGirl extends Model
{
    protected $fillable = [
        'local_id',
        'first_name', 
        'last_name', 
        'nickname', 
        'country_id',
        'age',
        'height',
        'weight',
        'sex',
        'sex_orientation',
        'type',
        'figure',
        'breast_size',
        'eye_color',
        'hair_color',
        'tattoos',
        'piercings',
        'body_hair',
        'intimate',
        'alcohol',
        'smoker',
        'about_me',
        'photos', 
        'videos', 
    ];

    public function local()
    {
        return $this->belongsTo('App\Models\Local');
    }
}
