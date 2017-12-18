<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Package;
use Illuminate\Http\Request;

class SessionController extends Controller
{
	public function storeDefaultPackage(Request $request)
	{
		if ($request->radioState == 'off' && Session::has('default_package')) {
			Session::forget('default_package');
			return response()->json([
				'success' => 'session expired',
			]);
		}
		$package = Package::find($request->package_id);
		if ($package) {
			Session::put('default_package', $package->id);
		} else {
			return redirect()->back();
		}
		return response()->json([
			'success' => true,
			'packagePrice' => Session::has('default_package') ? Session::get('default_package') : null
		]);
	}

	public function storeMonthPackage(Request $request)
	{
		if ($request->radioState != 'on' && Session::has('month_girl_package')) {
			Session::forget('month_girl_package');
			return response()->json([
				'success' => 'session expired',
			]);
		}
		$package = Package::find($request->package_id);
		if ($package) {
			Session::put('month_girl_package', $package->id);
		} else {
			return redirect()->back();
		}
		return response()->json([
			'success' => true,
			'packagePrice' => Session::has('month_girl_package') ? Session::get('month_girl_package') : null
		]);
	}

	public function storeGuestData()
	{
		
	}
}
