<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\User;
use App\Models\Canton;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;

class GirlController extends Controller
{
	public function getIndex(Request $request)
	{
		$services = Service::with('users')->get();
		$spokenLanguages = SpokenLanguage::with('users')->get();
		$maxPrice = \DB::table('prices')->max('service_price');
		$cantons = Canton::with('users')->get();

		$orderBy = $request->order_by ? $request->order_by : null;
        $mode = $request->mode == 'list' ? 'list' : 'grid';
		$show = $request->show ? $request->show : 9;
		$radius = $request->radius ? $request->radius : null;

		if ($radius && is_numeric($radius) && Session::has('lat') && Session::has('lng')) {
			$lat = Session::get('lat');
			$lng = Session::get('lng');
			$users = User::nearLatLng($lat, $lng, $radius, $request);
		} else {
			$users = User::leftJoin('prices', 'users.id', '=', 'prices.user_id')
			->leftJoin('cantons', 'users.canton_id', '=', 'cantons.id')
			->leftJoin('user_service', 'users.id', '=', 'user_service.user_id');

			if ($request->has('services')) {
				$users = $users->whereIn('user_service.service_id', $request->services);
			}

			if ($request->has('types')) {
				$users = $users->whereIn('users.type', $request->types);
			}

			if ($request->has('price_type')) {
				$users = $users->whereNotNull('users.' . $request->price_type . '_type');
			}

			if ($request->has('age')) {
				$inputAges = $request->age;
				foreach ($request->age as $key => $startAndEndAges) {
					$agesStrings = explode('-', $startAndEndAges);
					$startAge = $agesStrings[0];
					$endAge = $agesStrings[1];
					$users = $users->whereBetween('users.age', [$startAge, $endAge]);
				}
			}

			if ($request->has('price_from') && $request->has('price_to')) {
				$inputPriceFrom = $request->price_from;
				$inputPriceTo = $request->price_to;
				if ($inputPriceFrom == 0 && $inputPriceTo == $maxPrice) {
					$users = $users;
				} else {
					$users->whereBetween('prices.service_price', [$inputPriceFrom, $inputPriceTo]);
				}
			}

			$users = $users->where('users.is_active_d_package', '=', '1')
			->select('users.*')
			->groupBy('users.username');
		}

		$users = isset($orderBy) ? $users->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $users;

		if (Session::has('users')) {
			$users = Session::pull('users');
		} else {
			$users = $users->paginate($show);
		}

		$request->flash();

		return view('pages.girls.index', compact('services', 'users', 'cantons', 'spokenLanguages', 'pricesTypes', 'maxPrice', 'mode'));
	}

	public function getGirl($nickname)
	{
		$user = User::with('services', 'country', 'prices')->nickname($nickname)->first();

		if (!$user) {
			redirect()->url('/');
		}

		return view('pages.girls.single', compact('user'));
	}

	public function getPriceRanges(Request $request)
	{
		if ($request->ajax()) {
			$url = urldecode(route('private', $request->query(), false));
			return response()->json([
				'url' => $url
			]);
		}
	}

	public function getRadius(Request $request)
	{
		if ($request->ajax()) {
			$url = urldecode(route('private', $request->query(), false));
			return response()->json([
				'url' => $url
			]);
		}
	}

	public function tempLogin()
	{
		return view('temp_login');
	}
}
