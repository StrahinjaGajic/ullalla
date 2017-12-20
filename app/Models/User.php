<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['package1_expiry_date', 'package2_expiry_date'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function user_activation()
    {
        return $this->hasOne('App\Models\UserActivation');
    }

    public function user_type()
    {
        return $this->belongsTo('App\Models\UserType');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'user_service');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function spoken_languages()
    {
        return $this->belongsToMany('App\Models\SpokenLanguage', 'user_spoken_language')->withPivot('language_level');
    }

    public function canton()
    {
        return $this->belongsTo('App\Models\Canton');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function contact_options()
    {
        return $this->belongsToMany('App\Models\ContactOption', 'user_contact_option');
    }

    public function service_options()
    {
        return $this->belongsToMany('App\Models\ServiceOption', 'user_service_options');
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('role_name', $role)->first()) {
            return true;
        }

        return false;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public function assignRoles($roles)
    {
        if (is_array($roles)) {
            $rolesToBeAssign = Role::whereIn('role_name', $roles)->get()->toArray();
            $roleIds = [];
            $roleIds = array_column($rolesToBeAssign, 'id');
            $this->roles()->sync($roleIds);
        } else {
            $roleToBeAsign = Role::where('role_name', $roles)->first();
            $this->roles()->attach($roleToBeAsign);
        }
    }

    public function isAdmin()
    {
        return $this->hasRole('admin') ? true : false;
    }

    public static function scopeApproved($query)
    {
        $query->where('approved', '1');
    }

    public static function scopePayed($query)
    {
        $query->where('is_active_d_package', '1');
    }

    public static function scopeNickname($query, $nickname)
    {
        $query->where('nickname', $nickname);
    }

    public function hasContact()
    {
        return (
            $this->phone || 
            $this->mobile || 
            $this->contact_options()->count() || 
            $this->skype_name || 
            $this->prefered_contact_option
        ) ? true : false;
    }

    public function hasWorkplace()
    {
        return (
            $this->club_name || 
            $this->city || 
            $this->address || 
            $this->incall_type ||
            $this->outcall_type
        ) ? true : false;
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function getPackageExpireAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function scopeIsWithinMaxDistance($query, $location, $radius = 1) {

        $haversine = "(6371 * acos(cos(radians($location->lat)) 
                    * cos(radians(users.lat)) 
                    * cos(radians(users.lng) 
        - radians($location->lng)) 
        + sin(radians($location->lat)) 
                    * sin(radians(users.lat))))";
        return $query->select()
        ->selectRaw("{$haversine} AS distance")
        ->whereRaw("{$haversine} < ?", [$radius]);
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
                    * cos(radians(users.lat))
                    * cos(radians(users.lng)
        - radians($lng))
        + sin(radians($lat))
                    * sin(radians(users.lat)))))";

        $query->selectRaw("{$haversine} AS distance")
            ->leftJoin('prices', 'users.id', '=', 'prices.user_id')
            ->leftJoin('cantons', 'users.canton_id', '=', 'cantons.id')
            ->leftJoin('user_service', 'users.id', '=', 'user_service.user_id')
            ->leftJoin('user_spoken_language', 'users.id', '=', 'user_spoken_language.user_id')
            ->whereRaw(sprintf("lat BETWEEN %f AND %f", $latNorthBoundary, $latSouthBoundary))
            ->whereRaw(sprintf("lng BETWEEN %f AND %f", $lngEastBoundary, $lngWestBoundary));

        if ($request->has('canton')) {
            $query->whereIn('cantons.id', $request->canton);
        }
        if ($request->has('services')) {
            $query->whereIn('user_service.service_id', $request->services);
        }

        if ($request->has('languages')) {
            $query->whereIn('user_spoken_language.spoken_language_id', $request->languages);
        }

        if ($request->has('types')) {
            $query->whereIn('users.type', $request->types);
        }

        if ($request->has('price_type')) {
            $query->whereNotNull('users.' . $request->price_type . '_type');
        }

        if ($request->has('hair_color')) {
            $query->whereIn('users.hair_color', $request->hair_color);
        }

        if ($request->has('breast_size')) {
            $query->whereIn('users.breast_size', $request->breast_size);
        }

        if ($request->has('age')) {
            $inputAges = $request->age;
            foreach ($request->age as $key => $startAndEndAges) {
                $agesStrings = explode('-', $startAndEndAges);
                $startAge = $agesStrings[0];
                $endAge = $agesStrings[1];
                $query->whereBetween('users.age', [$startAge, $endAge]);
            }
        }

        $maxPrice = \DB::table('prices')->max('service_price');
        if ($request->has('price_from') && $request->has('price_to')) {
            $inputPriceFrom = $request->price_from;
            $inputPriceTo = $request->price_to;
            if ($inputPriceFrom == 0 && $inputPriceTo == $maxPrice) {
                $query = $query;
            } else {
                $query->whereBetween('prices.service_price', [$inputPriceFrom, $inputPriceTo]);
            }
        }

        $query->whereRaw("{$haversine} < ?", [$radius])
            ->groupBy('users.username');
        return $query;
    }
}
