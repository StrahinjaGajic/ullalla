<?php
# LANGUAGE CONTROLLER
Route::get('change_language/{language}', 'LanguageController@changeLanguage');

# Password Reset Controller
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

# HOME CONTROLLER
Route::get('/', 'HomeController@getIndex');
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

# GIRL CONTROLLER
Route::get('girls', [
	'as' => 'girls',
	'uses' => 'GirlController@getIndex'
]);
Route::get('girls/{nickname}', 'GirlController@getGirl');
Route::get('get_price_ranges', 'GirlController@getPriceRanges');
Route::get('get_radius', 'GirlController@getRadius');

#NOTIFICATION CONTROLLER
Route::get('@{username}/notifications', 'NotificationController@getIndex');

#CONTACT CONTROLLER
Route::get('contact', 'ContactController@getIndex');
Route::post('contact/send', 'ContactController@postIndex');

#FAQ CONTROLLER
Route::get('faq', 'FaqController@getIndex');

# SEARCH CONTROLLER
Route::post('search', 'SearchController@getQuickSeachResults');
Route::post('get_guest_data', 'SessionController@storeGuestData');



