<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function local()
    {
    	return $this->belongsTo('App\Models\Local');
    }
}
