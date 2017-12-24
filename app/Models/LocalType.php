<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalType extends Model
{
    protected $fillable = [
        'name_de', 'name_en', 'name_fr', 'name_it',
    ];

    public function locals()
    {
        return $this->hasMany('App\Models\Local');
    }
}
