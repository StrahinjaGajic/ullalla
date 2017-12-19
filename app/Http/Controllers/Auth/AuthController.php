<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Mail;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Local;
use App\Models\UserType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\ActivationMail;
use App\Events\PackageExpired;
use App\Events\LocalDefaultPackageExpired;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Controllers\Controller;
use App\Mail\DefaultPackageExpiredMail;
use App\Events\MonthOfTheGirlPackageExpired;
use App\Mail\GirlOfTheMonthPackageExpiredMail;

class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getSignout']);
	}

	public function getSignup()
	{
		$userTypes = UserType::all();
		return view('auth.signup', compact('userTypes'));
	}

	public function postSignup(SignUpRequest $request)
	{
		// create a new user
		if($request->user_type == 1) {
			$user = new User;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->user_type_id = $request->user_type;
			$user->save();
		}
		// create a new local
		if($request->user_type == 2) {
			$user = new Local;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->save();
		}

		// generate token
		$token = str_random(40);

		// insert data in user_activations table
		DB::table('user_activations')->insert(['user_id' => $user->id, 'token' => $token, 'user_type' => $request->user_type]);

		// get the token from the user_activations table
		$userActivation = DB::table('user_activations')->where('token', $token)->first();

		//send an email with the activation token used from user_activations table
		Mail::to($user->email)->send(new ActivationMail($userActivation));

		return redirect()->action('Auth\AuthController@getSignin')->with('success', __('messages.success_check_activation_link'));

	}

	public function getSignin()
	{
		return view('auth.signin');
	}

	public function postSignin(SignInRequest $request)
	{
		if (Auth::attempt($request->only(['username', 'password']))) {
			$user = Auth::user();
			if ($user->activated == '0') {
				Auth::logout();
				return redirect()->back()->with('error', __('messages.error_activate_account'));
			}

			if ($user->isAdmin()) {
				return redirect()->action('AdminController@getInactiveUsers');
			}

			// user can sign in
			if ($user->package1_id) {

				if ($user->approved == '0') {
					return redirect('/')->with('not_approved', __('messages.info_account_not_approved'));
				}

				$firstDateForGotmPackageExpiryNotification = null;

				$daysForExpiryDefaultPackage = getDaysForExpiry($user->package1_id);
				$firstDateForDefaultPackageExpiryNotification = getPackageExpiryDate($daysForExpiryDefaultPackage[0]);

				if ($user->package2_id) {
					$daysForExpiryGotmPackage = getDaysForExpiry($user->package2_id);
					$firstDateForGotmPackageExpiryNotification = getPackageExpiryDate($daysForExpiryGotmPackage[0]);
				}

				// get expiry dates from db
				$package1ExpiryDateCarbonParsed = Carbon::parse($user->package1_expiry_date);
				$package2ExpiryDateCarbonParsed = Carbon::parse($user->package2_expiry_date);
				$package1ExpiryDate = $package1ExpiryDateCarbonParsed->format('Y-m-d');
				$package2ExpiryDate = $package2ExpiryDateCarbonParsed->format('Y-m-d');

				// carbon now formated
				$carbonNowFormated = Carbon::now()->format('Y-m-d');

				// deactivate packages if it they are expired
				if (Carbon::now() >= $package2ExpiryDate) {
					$user->is_active_gotm_package = 0;
					$user->save();
					if (Carbon::now() < $package1ExpiryDate) {
						$url = url('@' . $user->username . '/packages');
						Session::flash('gotm_expired_package_info',
							__('messages.error_gotm_package_expired', ['url' => $url]));
					}
				}
				if (Carbon::now() >= $package1ExpiryDate) {
					$user->is_active_d_package = 0;
					$user->save();
					return redirect()->action('ProfileController@getPackages', ['username' => $user->username])
					->with('expired_package_info', __('messages.error_default_package_expired'));
				}

				// package expiry notifications
				if ($package1ExpiryDate < $firstDateForDefaultPackageExpiryNotification) {
					event(new PackageExpired($user));
					Session::flash('defaultGirlPackageExpired', __('messages.default_package_about_to_expire'));
				}
				
				if (isset($firstDateForGotmPackageExpiryNotification) && $package2ExpiryDate < $firstDateForGotmPackageExpiryNotification) {
					event(new MonthOfTheGirlPackageExpired($user));
					Session::flash('gotmPackageExpired', __('messages.gotm_package_about_to_expire'));
				}

				// $diff=date_diff(Carbon::now(), date_create($user->package1_expiry_date));
				// dd($diff->days);
				return redirect('/');
			} else {
				return redirect()->action('ProfileController@getCreate', ['username' => $user->username]);
			}
		} elseif (Auth::guard('local')->attempt(['username' => $request->username, 'password' => $request->password])) {
			$local = Auth::guard('local')->user();
			if ($local->activated != 1) {
				Auth::guard('local')->logout();
				return redirect()->back()->with('error', __('messages.error_activate_account'));
			}
			if ($local->package1_id) {
				if ($local->approved == '0') {
					return redirect('/')->with('not_approved', __('messages.info_account_not_approved'));
				}

				// get expiry dates from db
				$package1ExpiryDateCarbonParsed = Carbon::parse($local->package1_expiry_date);
				$package1ExpiryDate = $package1ExpiryDateCarbonParsed->format('Y-m-d');

				if (Carbon::now() >= $package1ExpiryDate) {
					$local->is_active_d_package = 0;
					$local->save();
					return redirect()->action('LocalController@getPackages', ['username' => $local->username])
					->with('expired_package_info', __('messages.error_default_package_expired'));
				}

				$daysForExpiryDefaultPackage = getDaysForExpiryLocal($local->package1_duration);

				// get expiry date days before expiration
				$firstDateForDefaultPackageExpiryNotification = getPackageExpiryDate($daysForExpiryDefaultPackage[0]);

				// package expiry notifications
				if ($package1ExpiryDate < $firstDateForDefaultPackageExpiryNotification) {
					event(new LocalDefaultPackageExpired($local));
					Session::flash('localDefaultPackageExpired', __('messages.default_package_about_to_expire'));
				}

				return redirect('/');
			} else {
				return redirect()->action('LocalController@getCreate', ['username' => $local->username]);
			}
		}
		return redirect()->back()->with('error', __('messages.wrong_credentials'));
	}

	public function getSignout()
	{
		Auth::logout();
		Auth::guard('local')->logout();
		return redirect('/signin');
	}

	public function userActivation($token)
	{
		$check = DB::table('user_activations')->where('token', $token)->first();

		if (!is_null($check)) {
			if ($check->user_type == 1) {
				$user = User::find($check->user_id);

				if ($user->activated == '1') {
					return redirect('signin')->with('error', __('messages.account_already_activated'));
				}

				$user = User::find($user->id);
				$user->activated = '1';
				$user->save();

				return redirect()->action('Auth\AuthController@getSignin')->with('success', 'Account successfully activated. You may now sign in.');
			}
			if ($check->user_type == 2) {
				$local = Local::find($check->user_id);

				if ($local->activated == '1') {
					return redirect('signin')->with('error', __('messages.account_already_activated'));
				}

				$local = Local::find($local->id);
				$local->activated = '1';
				$local->save();
				redirect()->action('Auth\AuthController@getSignin')->with('success',
					('messages.account_activated'));

				return redirect()->action('Auth\AuthController@getSignin')->with('success', 'Account successfully activated. You may now sign in.');
			}
			return redirect()->action('Auth\AuthController@getSignin')->with('error', __('messages.error_somethings_wrong'));
		}
		return redirect()->action('Auth\AuthController@getSignin')->with('error', __('messages.error_somethings_wrong'));
	}
}
