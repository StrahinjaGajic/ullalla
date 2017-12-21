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

		if ($request->type == 'girl') {
			return redirect(urldecode(route('girls', $query, false)));
		} elseif ($request->type == 'local') {
			return redirect(urldecode(route('locals', $query, false)));
		}
	}
}
