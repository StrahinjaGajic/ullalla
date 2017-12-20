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

		$radius = request('radius');
		$lat = Session::get('lat');
		$lng = Session::get('lng');
		$address = Session::get('address');

		$users = User::nearLatLng($lat, $lng, $radius)
		->where('approved', '=', '1')
		->where('is_active_d_package', '=', '1')
		->paginate(9);

		$query = $request->query();
		unset($query['type']);
		unset($query['_token']);
		unset($query['city']);

		Session::put('users', $users);
		Session::save();

		return redirect(urldecode(route('girls', $query, false)));
	}
}
