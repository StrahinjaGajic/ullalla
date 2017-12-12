<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactOption extends Model
{
	public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'contact_options');
    }
}
