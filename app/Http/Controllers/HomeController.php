<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Local;
use App\Models\Banner;
use App\Models\BannerPage;
use Illuminate\Http\Request;
Use Plivo;
use App\Charts\Visitors;
use App\Models\VisitorDateUser;

class HomeController extends Controller
{
	public function getIndex()
	{
//		$params = array(
//			'src' => '+381603198250',
//			'dst' => '+381621008770',
//			'text' => 'Hello world!'
//		);
//
//		$response = Plivo::sendSMS($params);
//dd($response);
		$bigBanners = BannerPage::getByPageId(1, 1)->get();
		$mediumBanner = BannerPage::getByPageId(1, 2)->first();
		$quarterBanners = BannerPage::getByPageId(1, 3, true)->take(4)->get();
		$verticalBanners = BannerPage::getByPageId(1, 4, true)->take(4)->get();
		$horizontalBanners = BannerPage::getByPageId(1, 5, true)->take(2)->get();

		$gotm = User::whereNotNull('package2_id')->where('sex', 'female')->inRandomOrder()->get();
		$totm = User::whereNotNull('package2_id')->where('sex', 'transsexual')->inRandomOrder()->get();
		$lotm = Local::whereNotNull('package2_id')->inRandomOrder()->get();
		$field = 'title_'. config()->get('app.locale');

		$user = Auth::user();

		$defaultPackageExpired = null;
		if ($user) {
			if ($user->package1_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id)[0]);
				$defaultPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->whereNull('users.scheduled_default_package')
				->where('notifications.' . $field, __('headings.default_package_expiration_title'))
				->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}

			if ($user->package2_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id)[0]);
				$gotmPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->whereNull('users.scheduled_gotm_package')
				->where('notifications.' . $field, __('headings.gotm_package_expiration_title'))
				->whereBetween('users.package2_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}
		}

		$user = Auth::guard('local')->user();
		if ($user) {
			if ($user->package1_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiryLocal($user->package1_duration)[0]);
				$localDefaultPackageExpired = DB::table('locals')
				->leftJoin('notifications', 'locals.id', '=', 'notifications.notifiable_id')
				->where('locals.id', $user->id)
				->whereNull('locals.scheduled_default_package')
				->where('notifications.' . $field, __('headings.local_default_package_expiration_title'))
				->whereBetween('locals.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}

			if ($user->package2_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id)[0]);
				$lotmPackageExpired = DB::table('users')
					->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
					->where('users.id', $user->id)
					->whereNull('users.scheduled_gotm_package')
					->where('notifications.' . $field, __('headings.lotm_package_expiration_title'))
					->whereBetween('users.package2_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}
		}

		return view('pages.home', compact(
			'defaultPackageExpired', 
			'gotmPackageExpired', 
			'lotmPackageExpired', 
			'localDefaultPackageExpired', 
			'gotm', 
			'totm', 
			'lotm',
			'bigBanners',
			'mediumBanner',
			'quarterBanners',
			'verticalBanners',
			'horizontalBanners'
		));
	}
}
