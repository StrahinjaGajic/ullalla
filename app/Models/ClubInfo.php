<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubInfo extends Model
{
    protected $table = 'clubs_info';

    protected $fillable = [
        'name', 'value', 'free',
    ];

    public function localEntrance()
    {
        return $this->belongsTo('App\Models\ClubInfo', 'club_entrance_id');
    }

    public function localWellness()
    {
        return $this->belongsTo('App\Models\ClubInfo', 'club_wellness_id');
    }

    public function localFood()
    {
        return $this->belongsTo('App\Models\ClubInfo', 'club_food_id');
    }

    public function localOutdoor()
    {
        return $this->belongsTo('App\Models\ClubInfo', 'club_outdoor_id');
    }
}
