<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Events;
use App\Models\LocalType;
use App\Models\Package;
use App\Models\LocalPackage;
use Illuminate\Http\Request;
use Stripe\{Charge, Customer};

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:local');
        $this->middleware('package.expiry', ['except' => ['getPackages', 'postPackages', 'getCreate', 'postCreate']]);
        $this->middleware('has_package', [
            'only' => [
                'getCreate',
                'postCreate'
            ]
        ]);
        $this->middleware('not_has_package', [
            'except' => [
                'getCreate', 'postCreate'
            ]
        ]);
    }

    public function getCreate()
    {
        $local = Auth::guard('local')->user();
        $packages = LocalPackage::all();
        $girlPackages = Package::all();
        $types = LocalType::all();
        return view('pages.locals.create', compact('local', 'types', 'packages', 'girlPackages'));
    }

    public function postCreate(Request $request)
    {
        $uploadedPhotos = storeAndGetUploadCareFiles(request('photos'));
        $inputPhotos = request('photos');

        // get the number of photos
        $request->merge(['photos' => (int) substr($inputPhotos, -2, 1)]);

        $this->validate($request, [
            'name' => 'required|max:30',
            'street' => 'required|max:30',
            'city' => 'required|max:30',
            'zip' => 'required|max:10',
            'phone' => 'required|max:20',
            'mobile' => 'required_with:sms_notifications,on|max:20',
            'photos' => 'numeric|min:4|max:9',
        ]);

        // get working time
        $workingTime = getWorkingTime(
            $request->days,
            $request->available_24_7,
            $request->time_from,
            $request->time_from_m,
            $request->time_to,
            $request->time_to_m
        );

        if(request('ullalla_package')[0] != 6) {
            $defaultPackageInput = request('ullalla_package')[0];
            $defaultPackage = LocalPackage::findOrFail($defaultPackageInput);
            $defaultPackageActivationDateInput = request('default_package_activation_date')[$defaultPackage->id];
            $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
            $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
            if (request('package_duration')[$defaultPackage->id] == 'month') {
                $defaultPackageExpiryDate = $carbonDate->addMonths(1)->format('Y-m-d H:i:s');
            } elseif (request('package_duration')[$defaultPackage->id] == 'year') {
                $defaultPackageExpiryDate = $carbonDate->addYears(1)->format('Y-m-d H:i:s');
            }
            $price = request('package_duration')[$defaultPackage->id] . '_price';
            $totalAmount = (int)filter_var($defaultPackage->$price, FILTER_SANITIZE_NUMBER_INT);

            $monthGirlPackageInput = request('ullalla_package_month_girl');
            if ($monthGirlPackageInput) {
                $monthGirlPackage = Package::findOrFail($monthGirlPackageInput[0]);
                $monthGirlActivationDateInput = request('month_girl_package_activation_date')[$monthGirlPackage->id];
                // format dates with carbon
                $carbonDate = Carbon::parse($monthGirlActivationDateInput);
                $monthGirlActivationDate = $carbonDate->format('Y-m-d H:i:s');
                $monthGirlExpiryDate = $carbonDate->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');
                $totalAmount += (int) filter_var($monthGirlPackage->package_price_local, FILTER_SANITIZE_NUMBER_INT);
            }
        }



        try {                        
            $user = Auth::guard('local')->user();
            $user->name = request('name');
            $user->phone = request('phone');
            $user->web = request('web');
            $user->street = request('street');
            $user->zip = request('zip');
            $user->city = request('city');
            $user->about_me = request('about_me');
            $user->local_type_id = request('local_type_id');
            $user->photo = storeAndGetUploadCareFiles(request('logo'));
            $user->photos = $uploadedPhotos ? $inputPhotos : null;
            $user->videos = storeAndGetUploadCareFiles(request('video'));
            $user->working_time = $workingTime;
            $user->club_entrance_id = setClubInfo('entrance', request('entrance'), request('entrance-free'));
            $user->club_wellness_id = setClubInfo('wellness', request('wellness'), request('wellness-free'));
            $user->club_food_id = setClubInfo('food', request('food'), request('food-free'));
            $user->club_outdoor_id = setClubInfo('outdoor', request('outdoor'), request('outdoor-free'));            
            if(request('ullalla_package')[0] != 6) {                
                $user->package1_id = $defaultPackage->id;
                $user->is_active_d_package = 1;
                $user->package1_duration = request('package_duration')[$defaultPackage->id];
                $user->package1_activation_date = $defaultPackageActivationDate;
                $user->package1_expiry_date = $defaultPackageExpiryDate;

                if (isset($monthGirlPackage)) {
                    $user->package2_id = $monthGirlPackage->id;
                    $user->is_active_gotm_package = 1;
                    $user->package2_activation_date = $monthGirlActivationDate;
                    $user->package2_expiry_date = $monthGirlExpiryDate;
                }
            }
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

        if(request('ullalla_package')[0] != 6) {
            try {
                // create a customer
                $customer = Customer::create([
                    'email' => request('stripeEmail'),
                    'source' => request('stripeToken'),
                ]);
                $user->stripe_id = $customer->id;
                $user->stripe_amount = $totalAmount;
                $user->save();
            } catch (\Exception $e) {
                return response()->json([
                    'status' => $e->getMessage()
                ], 422);
            }

            try {
                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => $user->stripe_amount,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            Session::flash('account_created', __('messages.account_created'));
        } else {
            Auth::guard('local')->logout();
            Session::put('account_created_elite', __('messages.account_created_elite'));
            Session::save();
        }
    }

    public function getContact()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.contact', compact('local'));
    }

    public function postContact(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:4|max:20',
            'email' => 'required|email|max:40',
            'confirm_password' => 'required_with:password|same:password',
            'name' => 'required|max:25',
            'street' => 'required|max:40',
            'city' => 'required|max:30',
            'zip' => 'required|max:10',
            'phone' => 'required_without:mobile|max:20',
            'mobile' => 'required_without:phone|required_with:sms_notifications,on|max:20',
        ], ['mobile.required_with' => __('validation.mobile_required_with_sms_checked')]
    );

        $local = Auth::guard('local')->user();
        $local->username = request('username');
        $local->email = request('email');
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
        } else {
            $request->merge(['password' => $local->password]);
        }
        $local->username = $request->username;
        $local->street = $request->street;
        $local->city = $request->city;
        $local->zip = $request->zip;
        $local->web = $request->web;
        $local->phone = $request->phone;
        $local->mobile = $request->mobile;
        $local->sms_notifications = request('sms_notifications') ? '1' : '0';

        $local->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getGallery()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.gallery', compact('local'));
    }

    public function postGallery(Request $request)
    {
        $local = Auth::guard('local')->user();
        $uploadedPhotos = storeAndGetUploadCareFiles(request('photos'));
        $inputPhotos = request('photos');

        // get the number of photos
        $request->merge(['photos' => (int) substr($inputPhotos, -2, 1)]);

        $this->validate($request, [
            'photos' => 'numeric|min:4|max:9',
        ]);

        $local->photo = storeAndGetUploadCareFiles(request('photo'));
        $local->photos = $uploadedPhotos ? $inputPhotos : null;
        $local->videos = storeAndGetUploadCareFiles(request('video'));
        $local->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getWorkingTimes()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.working_time', compact('local'));
    }

    public function postWorkingTimes(Request $request)
    {
        $local = Auth::guard('local')->user();
        $workingTime = getWorkingTime(
            $request->days,
            $request->available_24_7,
            $request->time_from,
            $request->time_from_m,
            $request->time_to,
            $request->time_to_m,
            $request->available_24_7_night_escort,
            $request->night_escorts
        );

        $local->working_time = $workingTime;
        $local->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getAbout()
    {
        $local = Auth::guard('local')->user();

        return view('pages.locals.about', compact('local'));
    }

    public function postAbout()
    {
        $local = Auth::guard('local')->user();
        $local->about_me = request('about_me');
        $local->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getClubInfo()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.club_info', compact('local'));
    }

    public function postClubInfo()
    {
        $local = Auth::guard('local')->user();

        editClubInfo($local->club_entrance_id, request('entrance'), request('entrance-free'));
        editClubInfo($local->club_wellness_id, request('wellness'), request('wellness-free'));
        editClubInfo($local->club_food_id, request('food'), request('food-free'));
        editClubInfo($local->club_outdoor_id, request('outdoor'), request('outdoor-free'));

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getGirls()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.girls', compact('local'));
    }

    public function postGirls(Request $request)
    {
        $local = Auth::guard('local')->user();

        foreach($local->girls as $girl) {
            $uploadedPhotos = storeAndGetUploadCareFiles(request('photos_'. $girl->id));
            $inputPhotos = request('photos_'. $girl->id);

            // get the number of photos
            $request->merge(['photos_'. $girl->id => (int) substr($inputPhotos, -2, 1)]);

            $this->validate($request, [
                'nickname_'. $girl->id => 'required|min:4|max:20',
                'photos_'. $girl->id => 'numeric|min:4|max:9',
            ]);

            $nickname = 'nickname_'. $girl->id;
            $girl->nickname = $request->$nickname;
            $girl->photos = $inputPhotos;
            $girl->save();
        }

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function postCreateGirls(Request $request)
    {
        $local = Auth::guard('local')->user();

        $photos = storeAndGetUploadCareFiles(request('newPhotos'));
        $inputPhotos = request('newPhotos');

        $request->merge(['newPhotos' => $inputPhotos]);
        $request->merge(['newPhotos' => substr($request->newPhotos, -2, 1)]);
        $request->merge(['newPhotos' => (int) $request->newPhotos]);

        $this->validate($request, [
            'nickname' => 'required|min:4|max:20',
            'newPhotos' => 'numeric|min:4|max:9',
        ]);

        $local->girls()->create([
            'nickname' => $request->nickname, 
            'photos' => $photos ? $inputPhotos : null,
            'local_id' => $local->id
        ]);

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getPackages()
    {
        $user = Auth::guard('local')->user();
        $packages = LocalPackage::all();
        $girlPackages = Package::all();

        $showDefaultPackages = false;
        $showGotmPackages = false;
        $dayFromWhichGotmPackagesShouldBeShown = null;

        $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiryLocal($user->package1_duration)[0])->format('Y-m-d');
        if ($user->package2_id) {
            $dayFromWhichGotmPackagesShouldBeShown = Carbon::parse($user->package2_expiry_date)->subDays(getDaysForExpiry($user->package2_id)[0])->format('Y-m-d');
        }

        if (Carbon::now() >= $dayFromWhichDefaultPackagesShouldBeShown) {
            $showDefaultPackages = true;
        }
        if (Carbon::now() >= $dayFromWhichGotmPackagesShouldBeShown) {
            $showGotmPackages = true;
        }
        return view('pages.locals.packages', compact('user', 'packages', 'girlPackages', 'showDefaultPackages', 'showGotmPackages'));
    }

    /**
     * Insert activation and expiry dates if both packages are chosen and billing the user.
     * If one of them is chosen then insert only that one and bill him.
     */
    public function postPackages(Request $request)
    {
        $user = Auth::guard('local')->user();

        $totalAmount = 0;
        $defaultPackageActivationDateInput = request('default_package_activation_date');
        $monthGirlActivationDateInput = request('month_girl_package_activation_date');

        if ($defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package' => 'required'
            ]);

            if ($validator->passes()) {
                // get default package input
                $defaultPackageInput = request('ullalla_package')[0];
                // get default package obj and activation date input
                $defaultPackage = LocalPackage::find($defaultPackageInput);
                if ($defaultPackage) {
                    if($defaultPackage->id != 6) {
                        $defaultPackageActivationDateInput = $defaultPackageActivationDateInput[$defaultPackage->id];
                        // format default packages dates with carbon
                        $currentExpiryDateParsed = Carbon::parse($user->package1_expiry_date);
                        $activationDateInputParsed = Carbon::parse($defaultPackageActivationDateInput);
                        $defaultPackageActivationDate = $activationDateInputParsed->format('Y-m-d H:i:s');

                        if (request('package_duration')[$defaultPackage->id] == 'month') {
                            $defaultPackageExpiryDate = $activationDateInputParsed->addMonths(1)->format('Y-m-d H:i:s');
                        } elseif (request('package_duration')[$defaultPackage->id] == 'year') {
                            $defaultPackageExpiryDate = $activationDateInputParsed->addYears(1)->format('Y-m-d H:i:s');
                        }

                        $price = request('package_duration')[$defaultPackage->id] . '_price';
                        $duration = request('package_duration')[$defaultPackage->id];
                        $totalAmount += (int)filter_var($defaultPackage->$price, FILTER_SANITIZE_NUMBER_INT);

                        // check if we should schedule the package or not
                        if (Carbon::now() <= $currentExpiryDateParsed) {
                            $string = $defaultPackage->id . '&|' . $duration . '&|' . $defaultPackageActivationDate . '&|' . $defaultPackageExpiryDate . '&|' . $totalAmount;
                            $user->scheduled_default_package = $string;
                            $user->save();

                            Session::flash('success', __('messages.scheduled_default_package'));

                            return response()->json([
                                'success' => true
                            ]);
                        } else {
                            $user->package1_id = $defaultPackage->id;
                            $user->is_active_d_package = 1;
                            $user->package1_duration = $duration;
                            $user->package1_activation_date = $defaultPackageActivationDate;
                            $user->package1_expiry_date = $defaultPackageExpiryDate;
                        }
                    } else {
                        $user->package1_id = null;
                    }
                    $user->save();
                }
            } else {
                return response()->json([
                    'errors' => [
                        'default_package_error' => $validator->getMessageBag()
                    ]
                ]);
            }
        }



        if ($monthGirlActivationDateInput && !$defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package_month_girl' => 'required'
            ]);
            // check if validator passed or not
            if ($validator->passes()) {
                $monthGirlPackageInput = request('ullalla_package_month_girl');
                if ($monthGirlPackageInput) {
                    // get package
                    $monthGirlPackage = Package::find($monthGirlPackageInput[0]);
                    // get activation date and expiry date
                    if ($monthGirlPackage) {
                        $monthGirlActivationDateInput = $monthGirlActivationDateInput[$monthGirlPackage->id];
                        // format dates with carbon
                        $currentExpiryDateParsed = Carbon::parse($user->package2_expiry_date);
                        $activationDateInputParsed = Carbon::parse($monthGirlActivationDateInput);
                        $monthGirlActivationDate = $activationDateInputParsed->format('Y-m-d H:i:s');
                        $monthGirlExpiryDate = $activationDateInputParsed->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');

                        $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                        // check if we should schedule the package or not
                        if (Carbon::now() <= $currentExpiryDateParsed) {
                            $string = $monthGirlPackage->id . '&|' . $monthGirlActivationDate . '&|' . $monthGirlExpiryDate . '&|' . $totalAmount;
                            $user->scheduled_gotm_package = $string;
                            $user->save();

                            Session::flash('success', __('messages.scheduled_gotm_package'));

                            return response()->json([
                                'success' => true
                            ]);
                        } else {
                            $user->package2_id = $monthGirlPackage->id;
                            $user->is_active_gotm_package = 1;
                            $user->package2_activation_date = $monthGirlActivationDate;
                            $user->package2_expiry_date = $monthGirlExpiryDate;
                        }
                    }
                }
            } else {
                return response()->json([
                    'errors' => [
                        'month_girl_package_error' => $validator->getMessageBag()
                    ]
                ]);
            }
        } elseif ($defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package' => 'required'
            ]);

            if ($validator->passes()) {
                // get default package input
                $defaultPackageInput = request('ullalla_package')[0];

                // get default package obj and activation date input
                $defaultPackage = Package::find($defaultPackageInput);
                if ($defaultPackage) {
                    if($defaultPackage->id != 6) {
                        $defaultPackageActivationDateInput = $defaultPackageActivationDateInput[$defaultPackage->id];
                        // format default packages dates with carbon
                        $currentExpiryDateParsed = Carbon::parse($user->package1_expiry_date);
                        $activationDateInputParsed = Carbon::parse($defaultPackageActivationDateInput);
                        $defaultPackageActivationDate = $activationDateInputParsed->format('Y-m-d H:i:s');

                        if (request('package_duration')[$defaultPackage->id] == 'month') {
                            $defaultPackageExpiryDate = $activationDateInputParsed->addMonths(1)->format('Y-m-d H:i:s');
                        } elseif (request('package_duration')[$defaultPackage->id] == 'year') {
                            $defaultPackageExpiryDate = $activationDateInputParsed->addYears(1)->format('Y-m-d H:i:s');
                        }

                        $price = request('package_duration')[$defaultPackage->id] . '_price';
                        $duration = request('package_duration')[$defaultPackage->id];
                        $totalAmount += (int)filter_var($defaultPackage->$price, FILTER_SANITIZE_NUMBER_INT);

                        // check if we should schedule the package or not
                        if (Carbon::now() <= $currentExpiryDateParsed) {
                            $string = $defaultPackage->id . '&|' . $duration . '&|' . $defaultPackageActivationDate . '&|' . $defaultPackageExpiryDate . '&|' . $totalAmount;
                            $user->scheduled_default_package = $string;
                            $user->save();

                            Session::flash('success', __('messages.scheduled_default_package'));

                            return response()->json([
                                'success' => true
                            ]);
                        } else {
                            $user->package1_id = $defaultPackage->id;
                            $user->is_active_d_package = 1;
                            $user->package1_duration = $duration;
                            $user->package1_activation_date = $defaultPackageActivationDate;
                            $user->package1_expiry_date = $defaultPackageExpiryDate;
                        }
                    } else {
                        $user->package1_id = null;
                    }
                    $user->save();
                }

                if ($monthGirlActivationDateInput) {
                    $monthGirlPackageInput = request('ullalla_package_month_girl');
                    if ($monthGirlPackageInput) {
                        // get package
                        $monthGirlPackage = Package::find($monthGirlPackageInput[0]);
                        // get activation date and expiry date
                        if ($monthGirlPackage) {
                            $monthGirlActivationDateInput = $monthGirlActivationDateInput[$monthGirlPackage->id];
                            // format dates with carbon
                            $currentExpiryDateParsed = Carbon::parse($user->package2_expiry_date);
                            $activationDateInputParsed = Carbon::parse($monthGirlActivationDateInput);
                            $monthGirlActivationDate = $activationDateInputParsed->format('Y-m-d H:i:s');
                            $monthGirlExpiryDate = $activationDateInputParsed->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');

                            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                            // check if we should schedule the package or not
                            if (Carbon::now() <= $currentExpiryDateParsed) {
                                $string = $monthGirlPackage->id . '&|' . $monthGirlActivationDate . '&|' . $monthGirlExpiryDate . '&|' . $totalAmount;
                                $user->scheduled_gotm_package = $string;
                                $user->save();

                                Session::flash('success', __('messages.scheduled_gotm_package'));

                                return response()->json([
                                    'success' => true
                                ]);
                            } else {
                                $user->package2_id = $monthGirlPackage->id;
                                $user->is_active_gotm_package = 1;
                                $user->package2_activation_date = $monthGirlActivationDate;
                                $user->package2_expiry_date = $monthGirlExpiryDate;
                            }
                        }
                    }
                }

                $user->save();
            } else {
                return response()->json([
                    'errors' => [
                        'default_package_error' => $validator->getMessageBag()
                    ]
                ]);
            }
        }




        if(request('ullalla_package')[0] != 6) {
            try {
                $customer = Customer::create([
                    'email' => request('stripeEmail'),
                    'source' => request('stripeToken'),
                ]);
                $user->stripe_id = $customer->id;
                $user->stripe_amount = $totalAmount;
                $user->save();

                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => $totalAmount * 100,
                    'currency' => 'chf',
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => $e->getMessage()
                ], 422);
            }

            Session::flash('success', __('messages.success_changes_saved'));
        }else{
            Auth::guard('local')->logout();
            Session::flash('account_created_elite', __('messages.account_created_elite'));
        }
    }

    public function getNewsAndEvents()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.news_events', compact('local', 'news', 'events'));
    }

    public function postNews(Request $request)
    {
        // if ($request->news_flyer == 'on') {
        //     $validator = Validator::make($request->all(), [
        //         'news_photo' => 'required',
        //     ]);
        // } else {
        //     $validator = Validator::make($request->all(), [
        //         'news_title' => 'required',
        //         'news_duration' => 'required',
        //         'news_description' => 'required',
        //         'news_photo' => 'required',
        //     ]);
        // }

        $explodedNewsDuration = explode(' - ', $request->news_duration);
        $from = Carbon::createFromFormat('d/m/Y', $explodedNewsDuration[0]);
        $to = Carbon::createFromFormat('d/m/Y', $explodedNewsDuration[1]);
        $newsDuration = $to->diffInDays($from);

        if ($validator->passes()) {
            $news = new News;
            $news->news_title = $request->news_title;
            $news->news_duration = $newsDuration;
            $news->news_description = $request->news_description;
            $news->news_photo = storeAndGetUploadCareFiles($request->news_photo);

            // $user->news()->save($news);
        } else {
            Session::flash('showNewsModal', true);
        }

        return redirect()->back()->withErrors($validator->getMessageBag());
    }

    public function postEvents(Request $request)
    {
        if ($request->events_flyer == 'on') {
            $validator = Validator::make($request->all(), [
                'events_photo' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'events_title' => 'required',
                'events_venue' => 'required',
                'events_date' => 'required',
                'events_duration' => 'required',
                'events_description' => 'required',
                'events_photo' => 'required',
            ]);
        }

        $explodedEventsDuration = explode(' - ', $request->events_duration);
        $from = Carbon::createFromFormat('d/m/Y', $explodedEventsDuration[0]);
        $to = Carbon::createFromFormat('d/m/Y', $explodedEventsDuration[1]);
        $eventDuration = $to->diffInDays($from);

        if ($validator->passes()) {
            $event = new Events;
            $event->events_title = $request->events_title;
            $event->events_venue = $request->events_venue;
            $event->events_date = $request->events_date;
            $event->events_duration = $eventDuration;
            $event->events_description = $request->events_description;
            $event->events_photo = storeAndGetUploadCareFiles($request->events_photo);
            
            // $user->events()->save($event);
        } else {
            Session::flash('showEventsModal', true);
        }

        return redirect()->back()->withErrors($validator->getMessageBag());
    }
}
