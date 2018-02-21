<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorDate extends Model
{
    protected $fillable = [
        'date'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'visitor_date_user');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\VisitorDateUser');
    }
}
