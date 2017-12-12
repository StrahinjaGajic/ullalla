<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_service');
    }
}
