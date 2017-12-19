<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Canton;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;
use Symfony\Component\HttpFoundation\Session\Session;

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
		$session = new Session();
		$lat = $session->get('lat');
		$lng = $session->get('lng');

		$users = User::nearLatLng($lat, $lng, $radius);
		$query = $request->query();
		unset($query['type']);
		unset($query['_token']);

		$session = new Session();
		$session->set('users', $users);
		// return view('pages.girls.index', compact('users', 'services', 'spokenLanguages', 'maxPrice', 'cantons'));

		return redirect(urldecode(route('girls', $query, false)));
	}
}
