<?php

namespace App\Http\Controllers;

use Session;
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
			'gender_type' => 'required',
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

		if ($request->gender_type == 'girl') {
			$users = User::nearLatLng($lat, $lng, $radius)->paginate(9);

			Session::put('users', $users);
			Session::save();

			return redirect(urldecode(route('private', $query, false)));
		} elseif ($request->gender_type == 'local') {
			$locals = Local::nearLatLng($lat, $lng, $radius)->paginate(9);

			Session::put('locals', $locals);
			Session::save();

			return redirect(urldecode(route('locals', $query, false)));
		}
	}
}
