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
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Controllers\Controller;
use App\Mail\DefaultPackageExpiredMail;
use App\Events\LocalDefaultPackageExpired;
use App\Events\MonthOfTheGirlPackageExpired;
use App\Events\MonthOfTheLocalPackageExpired;
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
			$user->activated = 1; // remove in production
			$user->save();
		}
		// create a new local
		if($request->user_type == 2) {
			$user = new Local;
			$user->username = $request->username;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);
			$user->activated = 1; // remove in production
			$user->save();
		}

		// generate token
		$token = str_random(40);

		// insert data in user_activations table
		DB::table('user_activations')->insert(['user_id' => $user->id, 'token' => $token, 'user_type' => $request->user_type]);

		// get the token from the user_activations table
		$userActivation = DB::table('user_activations')->where('token', $token)->first();

		//send an email with the activation token used from user_activations table
		// Mail::to($user->email)->send(new ActivationMail($userActivation)); // add in production

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

				// deactivate packages if it they are expired
				if ($user->package2_id && $user->is_active_gotm_package == 0) {
					if ($user->is_active_d_package == 1) {
						$url = url('@' . $user->username . '/packages');
						Session::flash('gotm_expired_package_info',
							__('messages.error_gotm_package_expired', ['url' => $url]));
					}
				}
				if ($user->is_active_d_package == 0) {
					return redirect()->action('ProfileController@getPackages', ['username' => $user->username])
					->with('expired_package_info', __('messages.error_default_package_expired'));
				}

				// package expiry notifications
				if ($package1ExpiryDate < $firstDateForDefaultPackageExpiryNotification) {
					event(new PackageExpired($user));
					Session::flash('defaultGirlPackageExpired', __('messages.default_package_about_to_expire'));
				}
				if ($firstDateForGotmPackageExpiryNotification !== null && $package2ExpiryDate < $firstDateForGotmPackageExpiryNotification) {
					event(new MonthOfTheGirlPackageExpired($user));
					Session::flash('gotmPackageExpired', __('messages.gotm_package_about_to_expire'));
				}

				// $diff=date_diff(Carbon::now(), date_create($user->package1_expiry_date));
				// dd($diff->days);
				return redirect('/');
			} else {
				return redirect()->action('ProfileController@getCreate', ['private_id' => $user->id]);
			}
		} elseif (Auth::guard('local')->attempt(['username' => $request->username, 'password' => $request->password])) {
			$local = Auth::guard('local')->user();
			if ($local->activated != 1) {
				Auth::guard('local')->logout();
				return redirect()->back()->with('error', __('messages.error_activate_account'));
			}
			// if ($local->name != "" && $local->package1_id == null) {
			// 	Auth::guard('local')->logout();
			// 	return redirect()->back()->with('error', __('messages.error_wait_admin'));
			// }
			if ($local->package1_id) {

				// get expiry dates from db
				$package1ExpiryDateCarbonParsed = Carbon::parse($local->package1_expiry_date);
				$package2ExpiryDateCarbonParsed = Carbon::parse($local->package2_expiry_date);
				$package1ExpiryDate = $package1ExpiryDateCarbonParsed->format('Y-m-d');
				$package2ExpiryDate = $package2ExpiryDateCarbonParsed->format('Y-m-d');

				if ($local->is_active_d_package == 0) {
					return redirect()->action('LocalController@getPackages', ['username' => $local->username])
					->with('expired_package_info', __('messages.error_default_package_expired'));
				}

				// deactivate packages if it they are expired
				if ($local->package2_id && $local->is_active_gotm_package == 0) {
					if ($local->is_active_d_package == 1) {
						$url = url('locals/@' . $local->username . '/packages');
						Session::flash('lotm_expired_package_info',
							__('messages.error_lotm_package_expired', ['url' => $url]));
					}
				}
				$daysForExpiryDefaultPackage = getDaysForExpiryLocal($local->package1_duration);
				$firstDateForDefaultPackageExpiryNotification = getPackageExpiryDate($daysForExpiryDefaultPackage[0]);

				// package expiry notifications
				if ($package1ExpiryDate < $firstDateForDefaultPackageExpiryNotification) {
					event(new LocalDefaultPackageExpired($local));
					Session::flash('localDefaultPackageExpired', __('messages.default_package_about_to_expire'));
				}

				if ($local->package2_id) {
					$daysForExpiryGotmPackage = getDaysForExpiry($local->package2_id);
					$firstDateForGotmPackageExpiryNotification = getPackageExpiryDate($daysForExpiryGotmPackage[0]);

					if ($firstDateForGotmPackageExpiryNotification !== null && $package2ExpiryDate < $firstDateForGotmPackageExpiryNotification) {
						event(new MonthOfTheLocalPackageExpired($local));
						Session::flash('lotmPackageExpired', __('messages.gotm_package_about_to_expire'));
					}
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

				return redirect()->action('Auth\AuthController@getSignin')->with('success', __('messages.account_activated'));
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
					__('messages.account_activated'));

				return redirect()->action('Auth\AuthController@getSignin')->with('success', __('messages.account_activated'));
			}
			return redirect()->action('Auth\AuthController@getSignin')->with('error', __('messages.error_somethings_wrong'));
		}
		return redirect()->action('Auth\AuthController@getSignin')->with('error', __('messages.error_somethings_wrong'));
	}

	public function countdown()
	{
		if (!Auth::check()) {
			return view('countdown_timer');
		} else {
			return redirect('/');
		}
	}
}
