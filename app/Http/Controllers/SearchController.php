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

		$users = User::nearLatLng($lat, $lng, $radius)->paginate(9);
		unset($request->query()['type']);
		unset($request->query()['_token']);

		return view('pages.girls.index', compact('users', 'services', 'spokenLanguages', 'maxPrice', 'cantons'));

		// return redirect(urldecode(route('girls', $request->query(), false)));
	}
}
