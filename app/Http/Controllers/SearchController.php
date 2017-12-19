<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Canton;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;

class SearchController extends Controller
{
	public function getQuickSeachResults(Request $request)
	{		
		$this->validate($request, [
			'type' => 'required',
			'radius' => 'required',
			'city' => 'required'
		]);

		$services = Service::with('users')->get();
		$spokenLanguages = SpokenLanguage::with('users')->get();
		$maxPrice = \DB::table('prices')->max('service_price');
		$cantons = Canton::with('users')->get();

		$radius = (int)request('radius');
		$lat = Session::get('lat');
		$lng = Session::get('lng');

		$users = User::nearLatLng($lat, $lng, $radius)
		->where('users.approved', '=', '1')
		->where('users.is_active_d_package', '=', '1')
		->paginate(9);
		$query = $request->query();
		unset($query['type']);
		unset($query['_token']);

		Session::put('users', $users);
		Session::save();
		
		return redirect(urldecode(route('girls', $query, false)));
	}
}
