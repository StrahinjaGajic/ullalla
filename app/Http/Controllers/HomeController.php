<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function getIndex()
	{
		$user = Auth::user();
		$defaultPackageExpired = null;
		if ($user) {
			if ($user->package1_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id)[0]);
				$defaultPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->where('notifications.title', 'Default Package Expiration')
				->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}


			if ($user->package2_id) {
				$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id)[0]);
				$gotmPackageExpired = DB::table('users')
				->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
				->where('users.id', $user->id)
				->where('notifications.title', 'Girl of The Month Package Expiration')
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
				->where('notifications.title', 'Local Default Package Expiration')
				->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
			}
		}

		return view('pages.home', compact('defaultPackageExpired', 'gotmPackageExpired', 'localDefaultPackageExpired'));
	}
}
