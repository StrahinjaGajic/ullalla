<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGirl extends Model
{
    protected $fillable = [
        'nickname', 'photos', 'local_id'
    ];

    public function local()
    {
        return $this->belongsTo('App\Models\Local');
    }
}
