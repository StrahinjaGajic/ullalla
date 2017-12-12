<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpokenLanguage extends Model
{
	public $timestamps = false;

	public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_spoken_language')->withPivot('language_level');
    }
}
