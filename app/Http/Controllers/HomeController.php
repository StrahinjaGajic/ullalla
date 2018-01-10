<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
Use Plivo;

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

		$gotm = User::whereNotNull('package2_id')->where('sex', 'female')->inRandomOrder()->get();
		$totm = User::whereNotNull('package2_id')->where('sex', 'transsexual')->inRandomOrder()->get();
		$field = 'title_'. config()->get('app.locale');

		$user = Auth::user();
		$defaultPackageExpired = null;
		if ($user) {
			if ($user->package1_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id)[0]);
				$defaultPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->where('notifications.' . $field, __('headings.default_package_expiration_title'))
				->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}


			if ($user->package2_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id)[0]);
				$gotmPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->where('notifications.' . $field, __('headings.gotm_package_expiration_title'))
				->whereBetween('users.package2_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}
		}

		$user = Auth::guard('local')->user();
		if ($user) {
			if ($user->package1_duration) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiryLocal($user->package1_duration)[0]);
				$localDefaultPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->where('notifications.' . $field, __('headings.local_default_package_expiration_title'))
				->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}
		}

		return view('pages.home', compact('defaultPackageExpired', 'gotmPackageExpired', 'localDefaultPackageExpired', 'gotm', 'totm'));
	}
}
