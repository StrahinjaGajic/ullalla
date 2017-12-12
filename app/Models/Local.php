<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Local extends Authenticatable
{
    use Notifiable;
    protected $quard = 'local';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'activated', 'approved', 'name', 'street', 'zip', 'city', 'web', 'phone', 'about_me', 'photo', 'photos', 'videos', 'working_time', 'club_entrance_id', 'club_wellness_id', 'club_food_id', 'club_outdoor_id', 'local_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function scopeUsername($query, $username)
    {
        $query->where('username', $username);
    }

    public static function scopeApproved($query)
    {
        $query->where('approved', '1');
    }

    public function clubEntrance()
    {
        return $this->hasOne('App\Models\ClubInfo', 'id', 'club_entrance_id');
    }

    public function clubWellness()
    {
        return $this->hasOne('App\Models\ClubInfo', 'id', 'club_wellness_id');
    }

    public function clubFood()
    {
        return $this->hasOne('App\Models\ClubInfo', 'id', 'club_food_id');
    }

    public function clubOutdoor()
    {
        return $this->hasOne('App\Models\ClubInfo', 'id', 'club_outdoor_id');
    }

    public function local_type()
    {
        return $this->belongsTo('App\Models\LocalType');
    }

    public function girls()
    {
        return $this->hasMany('App\Models\LocalGirl');
    }
}
