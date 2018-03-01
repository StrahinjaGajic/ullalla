<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Models\User;
use App\Models\Local;
use App\Models\Canton;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;

class SearchController extends Controller
{
	public function getQuickSeachResults(Request $request)
	{
		$this->validate($request, [
			'sexes.1' => 'required',
			'radius' => 'required',
			'city' => 'required'
		]);

		$radius = request('radius');
		$lat = Session::get('lat');
		$lng = Session::get('lng');
		$address = Session::get('address');

		$query = $request->query();
		unset($query['_token']);
		unset($query['city']);

		if (in_array('female', $request->sexes) || in_array('transsexual', $request->sexes)) {
			$users = User::nearLatLng($lat, $lng, $radius, $request)->paginate(9);

			Session::put('users', $users);
			Session::save();

			return redirect(urldecode(route('private', $query, false)));
		} elseif (in_array('local', $request->sexes)) {
			$locals = Local::nearLatLng($lat, $lng, $radius, $request)->paginate(9);

			Session::put('locals', $locals);
			Session::save();

			return redirect(urldecode(route('locals', $query, false)));
		}
	}
}
