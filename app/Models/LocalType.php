<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function locals()
    {
        return $this->hasMany('App\Models\Local');
    }
}
