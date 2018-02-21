<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use App\Models\Package;
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

    public static function scopePayed($query)
    {
        $query->where('is_active_d_package', '1');
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

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Events');
    }

    public function banners()
    {
        return $this->morphMany('App\Models\Banner', 'bannerable');
    }

    public function norifications()
    {
        return $this->morphMany('App\Models\Notifications', 'notifiable');
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
                $query->whereIn('locals.local_type_id', $request->types);
            }
        }

        $query->whereRaw("{$haversine} < ?", [$radius])
        ->where('locals.is_active_d_package', '=', '1')
        ->groupBy('locals.username');

        return $query;
    }

    public function visitors()
    {
        return $this->belongsToMany('App\Models\VisitorDate', 'visitor_date_user')->withPivot('visitors', 'active');
    }

    public static function insertGotmPackage($request, $user, $activationDateInput, $totalAmount, $gotm = false)
    {
        $packageInput = $request->ullalla_package_month_girl[0];
        $packageColumn = 'package2_id';
        $activeColumn = 'is_active_gotm_package';
        $activationDateColumn = 'package2_activation_date';
        $expiryDateColumn = 'package2_expiry_date';
        $scheduledColumn = 'scheduled_gotm_package';

        if ($packageInput) {
            // get package
            $package = Package::find($packageInput);
            // get activation date and expiry date
            if ($package) {
                $activationDateInput = $activationDateInput[$package->id];
                // format dates with carbon
                $currentExpiryDateParsed = Carbon::parse($user->$expiryDateColumn);
                $activationDateInputParsed = Carbon::parse($activationDateInput);
                $activationDate = $activationDateInputParsed->format('Y-m-d H:i:s');
                $expiryDate = $activationDateInputParsed->addDays(daysToAddToExpiry($package->id))->format('Y-m-d H:i:s');

                $totalAmount += (int) filter_var($package->package_price, FILTER_SANITIZE_NUMBER_INT);

                // check if we should schedule the package or not
                if (Carbon::now() <= $currentExpiryDateParsed) {
                    $string = $package->id . '&|' . $activationDate . '&|' . $expiryDate . '&|' . $totalAmount;
                    $user->$scheduledColumn = $string;
                    $user->save();

                    return ['needCharge' => false, 'scheduled' => true, 'totalAmount' => $totalAmount];
                } else {
                    if (DB::transactionLevel() != 1) {
                        DB::beginTransaction();
                    }

                    try {
                        // $user->canton_id = 'asdas';
                        $user->$packageColumn = $package->id;
                        $user->$activeColumn = 1;
                        $user->$activationDateColumn = $activationDate;
                        $user->$expiryDateColumn = $expiryDate;
                        $user->save();

                    } catch (Exception $e) {
                        DB::rollback();

                        return response()->json([
                            'status' => 'Something went wrong'
                        ], 422);
                    }

                    return ['needCharge' => true, 'scheduled' => false, 'totalAmount' => $totalAmount];
                }
            }
        }
    }

    public static function insertDefaultPackage($request, $user, $activationDateInput, $totalAmount)
    {
        $packageInput = $request->ullalla_package[0];
        $packageColumn = 'package1_id';
        $activeColumn = 'is_active_d_package';
        $activationDateColumn = 'package1_activation_date';
        $expiryDateColumn = 'package1_expiry_date';
        $scheduledColumn = 'scheduled_default_package';

        if ($packageInput) {
            // get package
            $package = Package::find($packageInput);
            // get activation date and expiry date
            if ($package) {
                if ($package->id != 6) {
                    $activationDateInput = $activationDateInput[$package->id];
                    // format dates with carbon
                    $currentExpiryDateParsed = Carbon::parse($user->$expiryDateColumn);
                    $activationDateInputParsed = Carbon::parse($activationDateInput);
                    $activationDate = $activationDateInputParsed->format('Y-m-d H:i:s');
                    $expiryDate = $activationDateInputParsed->addDays(daysToAddToExpiry($package->id))->format('Y-m-d H:i:s');

                    if (request('package_duration')[$package->id] == 'month') {
                        $expiryDate = $activationDateInputParsed->addMonths(1)->format('Y-m-d H:i:s');
                    } elseif (request('package_duration')[$package->id] == 'year') {
                        $expiryDate = $activationDateInputParsed->addYears(1)->format('Y-m-d H:i:s');
                    }

                    $price = request('package_duration')[$package->id] . '_price';
                    $duration = request('package_duration')[$package->id];

                    $totalAmount += (int) filter_var($package->package_price, FILTER_SANITIZE_NUMBER_INT);

                    // check if we should schedule the package or not
                    if ($user->package1_id && Carbon::now() <= $currentExpiryDateParsed) {
                        $string = $package->id . '&|' . $duration . '&|' . $activationDate . '&|' . $expiryDate . '&|' . $totalAmount;
                        $user->$scheduledColumn = $string;
                        $user->save();

                        return ['needCharge' => false, 'scheduled' => true, 'totalAmount' => $totalAmount];
                    } else {
                        if (DB::transactionLevel() != 1) {
                            DB::beginTransaction();
                        }

                        try {
                            // $user->canton_id = 'asdas';
                            $user->$packageColumn = $package->id;
                            $user->$activeColumn = 1;
                            $user->$activationDateColumn = $activationDate;
                            $user->$expiryDateColumn = $expiryDate;
                            $user->save();

                        } catch (Exception $e) {
                            DB::rollback();

                            return response()->json([
                                'status' => 'Something went wrong'
                            ], 422);
                        }

                        return ['needCharge' => true, 'scheduled' => false, 'totalAmount' => $totalAmount];
                    }
                }
            }
        }
    }
}
