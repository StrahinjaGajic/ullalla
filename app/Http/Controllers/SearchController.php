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

		$users = User::nearLatLng($lat, $lng, $radius)->get();
		$queryString = unset($request->query()['type'])

		return redirect(urldecode(route('girls', $queryString, false)));
    }
}
