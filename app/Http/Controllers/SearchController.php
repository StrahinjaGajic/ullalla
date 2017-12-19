<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getQuickSeachResults(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'radius' => 'required',
            'city' => 'required'
        ]);


		$radius = (int)request('radius');
		$lat = Session::get('lat');
		$lng = Session::get('lng');

		$haversine = "(6371 * acos(cos(radians('. $lat .'))
                * cos(radians(users.lat))
                * cos(radians(users.lng)
                - radians('. $lng .'))
                + sin(radians('. $lat .'))
                * sin(radians(users.lat))))";

		// $users = $users->select()
		//     			->whereRaw("{$haversine} < ?", [$radius]);
		$users = User::nearLatLng($lat, $lng, $radius)->get();

		dd($users);
    }
}
