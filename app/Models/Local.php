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

    public function package()
    {
        return $this->belongsTo('App\Models\LocalPackages');
    }

    public function scopeNearLatLng($query, $lat, $lng, $radius = 10, $request = null)
    {
        $distanceUnit = 111.045;

        if (!(is_numeric($lat) && $lat >= -90 && $lat <= 90)) {
            throw new Exception("Latitude must be between -90 and 90 degrees.");
        }

        if (!(is_numeric($lng) && $lng >= -180 && $lng <= 180)) {
            throw new Exception("Longitude must be between -180 and 180 degrees.");
        }

        $latDistance      = $radius / $distanceUnit;
        $latNorthBoundary = $lat - $latDistance;
        $latSouthBoundary = $lat + $latDistance;

        $lngDistance     = $radius / ($distanceUnit * cos(deg2rad($lat)));
        $lngEastBoundary = $lng - $lngDistance;
        $lngWestBoundary = $lng + $lngDistance;


        $haversine = "(111.045 * degrees(acos(cos(radians($lat))
                    * cos(radians(locals.lat))
                    * cos(radians(locals.lng)
        - radians($lng))
        + sin(radians($lat))
                    * sin(radians(locals.lat)))))";

        $query
        ->select('locals.*')
        ->selectRaw("{$haversine} AS distance")
        ->whereRaw(sprintf("lat BETWEEN %f AND %f", $latNorthBoundary, $latSouthBoundary))
        ->whereRaw(sprintf("lng BETWEEN %f AND %f", $lngEastBoundary, $lngWestBoundary));

        if ($request) {
            if ($request->has('types')) {
                $locals = $locals->whereIn('locals.local_type_id', $request->types);
            }
        }

        $query->whereRaw("{$haversine} < ?", [$radius])
        ->where('locals.approved', '=', '1')
        ->where('locals.is_active_d_package', '=', '1')
        ->groupBy('locals.username');

        return $query;
    }
}
