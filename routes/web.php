<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cookie;

Route::get('/polarna_kobra', function() { // remove in production
    return view('testprotection');
})->name('temp_login');

Route::post('/polarna_kobra', function() { // remove in production
    $_username = 'milan';
    $_password = 'vejn123123';

    $username = Request::input('username');
    $password = Request::input('password');

    if (($username == $_username) && ($password == $_password)) {
        Cookie::queue(Cookie::make('temp_login', true, 3600));
        return redirect('/');
    } else {
        echo "Wrong username or password";
    }
});

// Route::group(['middleware' => 'maintenance'], function () { // remove in production
	# LANGUAGE CONTROLLER
Route::get('change_language/{language}', 'LanguageController@changeLanguage');

# Password Reset Controller
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

# HOME CONTROLLER
// Route::middleware(['web', 'front.auth'])->group( function () { // remove in productions
	Route::get('/', 'HomeController@getIndex');
// });
# AUTH CONTROLLER
Route::get('/signin', 'Auth\AuthController@getSignin');
Route::post('/signin', 'Auth\AuthController@postSignin');
Route::get('/signup', 'Auth\AuthController@getSignup');
Route::post('/signup', 'Auth\AuthController@postSignup');
Route::get('/signout', 'Auth\AuthController@getSignout');

# USER ACTIVATION
Route::get('user/activation/{token}', 'Auth\AuthController@userActivation');

# PROFILE CONTROLLER
Route::get('@{username}/create', 'ProfileController@getCreate');
Route::put('@{username}/store', 'ProfileController@postCreate');
Route::post('ajax/add_new_price', 'ProfileController@postNewPrice');
Route::get('ajax/delete_price/{price_id}', 'ProfileController@deletePrice');
# update profile separately one by one
Route::get('@{username}/bio', 'ProfileController@getBio');
Route::put('@{username}/bio/store', 'ProfileController@postBio');

Route::get('@{username}/about_me', 'ProfileController@getAbout');
Route::put('@{username}/about_me/store', 'ProfileController@postAbout');

Route::get('@{username}/gallery', 'ProfileController@getGallery');
Route::put('@{username}/gallery/store', 'ProfileController@postGallery');

Route::get('@{username}/contact', 'ProfileController@getContact');
Route::put('@{username}/contact/store', 'ProfileController@postContact');

Route::get('@{username}/services', 'ProfileController@getServices');
Route::put('@{username}/services/store', 'ProfileController@postServices');

Route::get('@{username}/workplace', 'ProfileController@getWorkplace');
Route::put('@{username}/workplace/store', 'ProfileController@postWorkplace');

Route::get('@{username}/working_time', 'ProfileController@getWorkingTimes');
Route::put('@{username}/working_time/store', 'ProfileController@postWorkingTimes');

Route::get('@{username}/job_offers', 'ProfileController@getJobOffers');
Route::put('@{username}/job_offers/store', 'ProfileController@postJobOffers');

Route::get('@{username}/prices', 'ProfileController@getPrices');

Route::get('@{username}/packages', 'ProfileController@getPackages');
Route::put('@{username}/packages/store', 'ProfileController@postPackages');

Route::get('@{username}/languages', 'ProfileController@getLanguages');
Route::put('@{username}/languages/store', 'ProfileController@postLanguages');

Route::get('@{username}/banners', 'ProfileController@getBanners');
Route::put('@{username}/banners/store', 'ProfileController@postBanners');

# LOCAL CONTROLLER
Route::get('locals/@{username}/create', 'LocalController@getCreate');
Route::put('locals/@{username}/store', 'LocalController@postCreate');

Route::get('locals/@{username}/contact', 'LocalController@getContact');
Route::put('locals/@{username}/contact/store', 'LocalController@postContact');

Route::get('locals/@{username}/gallery', 'LocalController@getGallery');
Route::put('locals/@{username}/gallery/store', 'LocalController@postGallery');

Route::get('locals/@{username}/working_time', 'LocalController@getWorkingTimes');
Route::put('locals/@{username}/working_time/store', 'LocalController@postWorkingTimes');

Route::get('locals/@{username}/about_me', 'LocalController@getAbout');
Route::put('locals/@{username}/about_me/store', 'LocalController@postAbout');

Route::get('locals/@{username}/club_info', 'LocalController@getClubInfo');
Route::put('locals/@{username}/club_info/store', 'LocalController@postClubInfo');

Route::get('locals/@{username}/girls', 'LocalController@getGirls');
Route::put('locals/@{username}/girls/store', 'LocalController@postGirls');
Route::put('locals/@{username}/girls/create', 'LocalController@postCreateGirls');

Route::get('locals/@{username}/packages', 'LocalController@getPackages');
Route::put('locals/@{username}/packages/store', 'LocalController@postPackages');

# LOCAL PROFILE CONTROLLER
Route::get('locals/{username}', 'LocalProfileController@getLocal');
Route::get('locals', [
	'as' => 'locals',
	'uses' => 'LocalProfileController@getIndex'
]);

# SESSION CONTROLLER
Route::post('ajax/store_default_package', 'SessionController@storeDefaultPackage');
Route::post('ajax/store_month_girl_package', 'SessionController@storeMonthPackage');

# ADMIN CONTROLLER
Route::middleware(['roles'])->group(function () {
	Route::get('admin/inactive_users', [
		'uses' => 'AdminController@getInactiveUsers',
		'roles' => ['Admin']
	]);
	Route::post('admin/inactive_users/approve/{id}', [
		'uses' => 'AdminController@approveUser',
		'roles' => ['Admin']
	]);
	Route::get('admin/inactive_locals', [
		'uses' => 'AdminController@getInactiveLocals',
		'roles' => ['Admin']
	]);
	Route::post('admin/inactive_locals/approve/{id}', [
		'uses' => 'AdminController@approveLocal',
		'roles' => ['Admin']
	]);
});

# BLACK BOOK CONTROLLER
Route::get('private/blackbook', 'BlackbookController@getIndex');
Route::post('private/blackbook/store', 'BlackbookController@postBlackbook');

# GIRL CONTROLLER
Route::get('private', [
	'as' => 'private',
	'uses' => 'GirlController@getIndex'
]);
Route::get('private/{nickname}', 'GirlController@getGirl');
Route::get('get_price_ranges', 'GirlController@getPriceRanges');
Route::get('get_radius', 'GirlController@getRadius');
Route::get('get_local_radius', 'LocalProfileController@getLocalRadius');

#NOTIFICATION CONTROLLER
Route::get('@{username}/notifications', 'NotificationController@getIndex');

#CONTACT CONTROLLER
Route::get('contact', 'ContactController@getIndex');
Route::post('contact/send', 'ContactController@postIndex');

#FAQ CONTROLLER
Route::get('faq', 'FaqController@getIndex');

# SEARCH CONTROLLER
Route::get('search', 'SearchController@getQuickSeachResults');
Route::post('get_guest_data', 'SessionController@storeGuestData');
// });

// Route::get('/home', 'Auth\AuthController@countdown')->name('countdown');
// Route::get('/polarna_kobra', 'GirlController@tempLogin')->name('tempLogin');
