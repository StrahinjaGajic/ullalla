<?php

namespace App\Http\Controllers;

use DB;
use Charts;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Canton;
use App\Models\Service;
use App\Models\BannerPage;
use App\Models\VisitorDate;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;
use App\Models\VisitorDateUser;

class GirlController extends Controller
{
	public function getIndex(Request $request)
	{
		$smallBanners = BannerPage::getByPageId(1, 3, true)->take(4)->get();
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

			if ($request->has('sexes')) {
				$users = $users->whereIn('users.sex', $request->sexes);
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

		return view('pages.girls.index', compact('services', 'users', 'cantons', 'spokenLanguages', 'pricesTypes', 'maxPrice', 'mode', 'smallBanners'));
	}

	public function getGirl($id)
	{
		$smallBanners = BannerPage::getByPageId(1, 3, true)->take(4)->get();

		if(Auth()->user() && $id != Auth()->user()->id){
			$visits = VisitorDateUser::join('visitor_dates', 'visitor_dates.id', '=', 'visitor_date_user.visitor_date_id')->select('visitor_dates.id AS date_id', 'visitor_dates.date', 'visitor_date_user.*')->get();
			$checkForDate = false;
			foreach($visits as $visit){
				if(date('d-m-Y', strtotime($visit->date)) == date('d-m-Y') && $visit->user_id == $id){
					$visit->visitors = $visit->visitors + 1;
					$visit->save();
					$checkForDate = true;
				}
			}

			if(!$checkForDate){
				$dates = VisitorDate::all();
				$check = false;
				foreach($dates as $date){
					if(date('d-m-Y', strtotime($date->date)) == date('d-m-Y')){
						$check = true;
					}
				}
				if(!$check) {
					$date = new VisitorDate;
					$date->date = Carbon::now();
					$date->save();
				}

				$visit = new VisitorDateUser;
				$visit->visitor_date_id = $date->id;
				$visit->user_id = $id;
				$visit->visitors = 1;
				$visit->active = 0;
				$visit->save();
			}
		}
		if(Auth()->user() && $id == Auth()->user()->id){
			$user = User::findOrFail($id);
			$values_month = [];
			$dates_month = [];
			$num = 0;
			foreach ($user->visitors as $visitor) {
				if ($visitor->pivot->active) {
					$values_month[$num] = $visitor->pivot->visitors;
					$dates_month[$num] = date("d-m", strtotime($visitor->date));
					$num++;
				}
			}

			$chart_month = Charts::multi('bar', 'highcharts')
				->title(__('functions.visitors'))
				->dimensions(0, 400)
				->template("highcharts")
				->dataset(__('functions.visitors'), $values_month)
				->labels($dates_month);

			if($user->year_visitors) {
				$values_year = [];
				$dates_year = [];
				$num = 0;
				foreach (explode(', ', $user->year_visitors) as $visitor) {
					$visitor = explode(':', $visitor);
					$values_year[$num] = $visitor[1];
					$dates_year[$num] = __('global.' . date("F", strtotime($visitor[0])));
					$num++;
				}
				$chart_year = Charts::multi('bar', 'highcharts')
					->title(__('functions.visitors'))
					->dimensions(0, 400)
					->template("highcharts")
					->dataset(__('functions.visitors'), $values_year)
					->labels($dates_year);
			}
		}

		$user = User::with('services', 'country', 'prices')->findOrFail($id);

		return view('pages.girls.single', compact('user', 'chart_month', 'chart_year', 'smallBanners'));
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
}
