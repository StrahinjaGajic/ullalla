<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\News;
use App\Models\Local;
use App\Models\Events;
use App\Models\Country;
use App\Models\Package;
use App\Models\Service;
use App\Models\LocalType;
use App\Models\LocalPackage;
use App\Rules\OlderThanRule;
use Illuminate\Http\Request;
use App\Models\ServiceOption;
use App\Models\SpokenLanguage;
use Stripe\{Charge, Customer};

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:local');
        $this->middleware('package.expiry', [
            'except' => [
                    'getPackages', 
                    'postPackages', 
                    'getCreate', 
                    'postCreate'
                ]
            ]);
        $this->middleware('has_profile', [
            'only' => [
                'getCreate',
                'postCreate'
            ]
        ]);
        $this->middleware('has_no_profile', [
            'except' => [
                'getCreate', 
                'postCreate'
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
            'mobile' => 'required_without:phone|required_with:sms_notifications,on|max:20',
            'photos' => 'numeric|min:4|max:9',
        ], 
            ['mobile.required_with' => __('validation.mobile_required_with_sms_checked')]
        );

        // define lng and lat
        $address = request('street');
        $city = request('city');
        $fullAddress = $address && $city ? $address . ', ' . $city : null;
        $lat = null;
        $lng = null;

        if ($fullAddress) {
            $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&libraries=places&address='.urlencode($fullAddress).'&sensor=true');
            $geo = json_decode($geo, true);

            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $lat = $geo['results'][0]['geometry']['location']['lat'];
                $lng = $geo['results'][0]['geometry']['location']['lng'];
            }
        }

        // get working time
        $workingTime = getWorkingTime(
            $request->days,
            $request->available_24_7,
            $request->time_from,
            $request->time_from_m,
            $request->time_to,
            $request->time_to_m
        );

        try {                        
            $user = Auth::guard('local')->user();
            $user->has_profile = 1;
            $user->name = request('name');
            $user->phone = request('phone');
            $user->mobile = $request->dial_code . ' ' . $request->mobile;
            $user->sms_notifications = request('sms_notifications') ? '1' : '0';
            $user->website = request('website');
            $user->street = $address;
            $user->zip = request('zip');
            $user->city = $city;
            $user->lat = $lat;
            $user->lng = $lng;
            $user->about_me = request('about_me');
            $user->local_type_id = request('local_type_id');
            $user->photo = request('logo') ? storeAndGetUploadCareFiles(request('logo')) . '-/overlay/f90362fd-8c5f-4daf-8c1b-7f1ca3ca90f8/120x25/150,140/50p/' : NULL;
            $user->photos = $uploadedPhotos ? $inputPhotos : null;
            $user->videos = storeAndGetUploadCareFiles(request('video'));
            $user->working_time = $workingTime;
            $user->club_entrance_id = setClubInfo('entrance', request('entrance'), request('entrance-free'));
            $user->club_wellness_id = setClubInfo('wellness', request('wellness'), request('wellness-free'));
            $user->club_food_id = setClubInfo('food', request('food'), request('food-free'));
            $user->club_outdoor_id = setClubInfo('outdoor', request('outdoor'), request('outdoor-free'));            

            $user->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'There was a problem creating your profile.'
            ], 422);
        }


        Session::flash('account_created', __('messages.account_created'));

        return redirect('/');
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
            ], 
            ['mobile.required_with' => __('validation.mobile_required_with_sms_checked')]
        );

        // define lng and lat
        $address = request('street');
        $city = request('city');
        $fullAddress = $address && $city ? $address . ', ' . $city : null;
        $lat = null;
        $lng = null;

        if ($fullAddress) {
            $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBZdaqR1wW7f-IealrpiTna-fBPPawZVY4&libraries=places&address='.urlencode($fullAddress).'&sensor=true');
            $geo = json_decode($geo, true);

            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $lat = $geo['results'][0]['geometry']['location']['lat'];
                $lng = $geo['results'][0]['geometry']['location']['lng'];
            }
        }

        // update contact
        $local = Auth::guard('local')->user();
        $local->username = request('username');
        $local->email = request('email');
        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
        } else {
            $request->merge(['password' => $local->password]);
        }
        $local->username = $request->username;
        $local->name = $request->name;
        $local->street = $address;
        $local->city = $city;
        $local->zip = $request->zip;
        $local->lat = $lat;
        $local->lng = $lng;
        $local->website = $request->web;
        $local->phone = $request->phone;
        $local->mobile = $request->dial_code . ' ' . $request->mobile;
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

        $local->photo = request('photo') ? storeAndGetUploadCareFiles(request('photo')) . '-/overlay/f90362fd-8c5f-4daf-8c1b-7f1ca3ca90f8/120x25/150,140/50p/' : NULL;
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
            $request->time_to_m
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

    public function postAbout(Request $request)
    {
        $this->validate($request, [
            'about_me' => 'required',
        ]);
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

        $services = Service::all();
        $countries = Country::all();
        $spokenLanguages = SpokenLanguage::all();
        $serviceOptions = ServiceOption::all();

        return view('pages.locals.girls', compact('local', 'countries', 'services', 'spokenLanguages', 'serviceOptions'));
    }

    public function postCreateGirl(Request $request)
    {
        $local = Auth::guard('local')->user();
        $numOfGirls = User::where('local_id', $local->id)->count();
        if($numOfGirls >= $local->package->max_girls){
            return redirect()->back()->with('err_max_girls', __('messages.err_max_girls'));
        }
        $uploadedPhotos = storeAndGetUploadCareFiles(request('photos'));
        $inputPhotos = request('photos');

        // get the number of photos
        $request->merge(['photos' => (int) substr($inputPhotos, -2, 1)]);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'nickname' => 'required',
            'age' => ['required', 'numeric', new OlderThanRule],
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'sex' => 'required',
            'sex_orientation' => 'required',
            'intimate' => 'required',
            'alcohol' => 'required',
            'smoker' => 'required',
            'about_me' => 'required|max:200',
            'photos' => 'numeric|min:4|max:9',
        ]);

        try {
            $user = new User;
            $user->username = 'konjina';
            $user->email = 'random@random.com';
            $user->user_type_id = 1;
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->nickname = request('nickname');
            $user->age = request('age');
            $user->country_id = request('nationality_id');
            $user->sex = request('sex');
            $user->sex_orientation = request('sex_orientation');
            $user->height = request('height');
            $user->weight = request('weight');
            $user->type = request('type');
            $user->figure = request('figure');
            $user->breast_size = request('breast_size');
            $user->eye_color = request('eye_color');
            $user->hair_color = request('hair_color');
            $user->tattoos = request('tattoos');
            $user->piercings = request('piercings');
            $user->body_hair = request('body_hair');
            $user->intimate = request('intimate');
            $user->smoker = request('smoker');
            $user->alcohol = request('alcohol');
            $user->about_me = request('about_me');
            $user->photos = $uploadedPhotos ? $inputPhotos : null;
            $user->videos = storeAndGetUploadCareFiles(request('video'));
            
            $user->save();

            // define languages input
            $spokenLanguages = array_filter(request('spoken_language'), function($value) { return $value != '0' && $value != null; });

            // define levels
            $levels = array_map(function($languageLevel) {
                return ['language_level' => $languageLevel];
            }, $spokenLanguages);
            // get combined data
            $syncData = array_combine(array_keys($spokenLanguages), $levels);

            // sync services to the user
            $user->services()->sync(request('services'));
            $user->spoken_languages()->sync($syncData);

            $local->users()->save($user);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

        return redirect()->back()->with('success', __('messages.girl_added_success'));
    }

    public function getPackages()
    {
        $user = Auth::guard('local')->user();
        $packages = LocalPackage::all();
        $girlPackages = Package::all();

        $showDefaultPackages = false;
        $showGotmPackages = false;
        $dayFromWhichDefaultPackagesShouldBeShown = null;
        $dayFromWhichGotmPackagesShouldBeShown = null;

        $scheduledDefaultPackage = $user->scheduled_default_package;
        $scheduledGotmPackage = $user->scheduled_gotm_package;

        
        if ($user->package1_id) {
            $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiryLocal($user->package1_duration)[0])->format('Y-m-d');
        }
        if ($user->package2_id) {
            $dayFromWhichGotmPackagesShouldBeShown = Carbon::parse($user->package2_expiry_date)->subDays(getDaysForExpiry($user->package2_id)[0])->format('Y-m-d');
        }

        if ($scheduledDefaultPackage === null && Carbon::now() >= $dayFromWhichDefaultPackagesShouldBeShown) {
            $showDefaultPackages = true;
        }
        if ($scheduledGotmPackage === null && Carbon::now() >= $dayFromWhichGotmPackagesShouldBeShown) {
            $showGotmPackages = true;
        }

        return view('pages.locals.packages', compact(
            'user', 
            'packages', 
            'girlPackages', 
            'showDefaultPackages', 
            'showGotmPackages',
            'scheduledDefaultPackage',
            'scheduledGotmPackage'
        ));
    }

    /**
     * Insert activation and expiry dates if both packages are chosen and billing the user.
     * If one of them is chosen then insert only that one and bill him.
     */
    public function postPackages(Request $request)
    {
        $user = Auth::guard('local')->user();

        $defaultPackageData = ['elite' => false, 'scheduled' => false, 'totalAmount' => 0];
        $gotmPackageData = ['scheduled' => false, 'totalAmount' => 0];

        $totalAmount = 0;
        $defaultPackageActivationDateInput = request('default_package_activation_date');
        $monthGirlActivationDateInput = request('month_girl_package_activation_date');

        if ($monthGirlActivationDateInput && !$defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package_month_girl' => 'required'
            ], [
                __('validation.lotm_package_required')
            ]);
            // check if validator passed or not
            if ($validator->passes()) {
                // insert gotm package
                $gotmPackageData = Local::insertGotmPackage($request, $user, $monthGirlActivationDateInput, $totalAmount, true);
                // check if gotm package is scheduled or not 
                if ($gotmPackageData['scheduled'] === true) {
                    // scheduled
                    Session::flash('success_gotm_scheduled', __('messages.scheduled_lotm_package'));
                } else {
                    // not scheduled
                    Session::flash('success_gotm_package_updated', __('messages.lotm_package_successfully_saved'));
                }

                // advance to payment
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'errors' => $validator->getMessageBag()
                    ]);
                }

                return redirect()->back()->withErrors($validator->getMessageBag());
            }
        } elseif ($defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package' => 'required'
            ], [
                __('validation.default_package_required')
            ]);

            if ($validator->passes()) {
                // insert default package
                $defaultPackageData = Local::insertDefaultPackage($request, $user, $defaultPackageActivationDateInput, $totalAmount);
                // insert gotm package
                if ($monthGirlActivationDateInput || $defaultPackageData['elite'] === false) {
                    $gotmPackageData = Local::insertGotmPackage($request, $user, $monthGirlActivationDateInput, $totalAmount, true);
                    if ($gotmPackageData['scheduled'] === true) {
                        // gotm package scheduled
                        Session::flash('success_gotm_scheduled', __('messages.scheduled_lotm_package'));                        
                    } else if ($gotmPackageData['scheduled'] === false) {
                        // gotm package not scheduled
                        Session::flash('success_gotm_package_updated', __('messages.lotm_package_successfully_saved'));
                    }
                }

                // check if default package is scheduled or not
                if ($defaultPackageData['scheduled'] === true) {
                    Session::flash('success_d_scheduled', __('messages.scheduled_default_package'));
                } else {
                    Session::flash('success_d_package_updated', __('messages.d_package_successfully_saved'));
                }

                // advance to payment

            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'errors' => $validator->getMessageBag()
                    ]);
                }

                return redirect()->back()->withErrors($validator->getMessageBag());
            }
        }

        if (request('ullalla_package')[0] != 6) {
            try {
                $customer = null;

                if ($user->stripe_last4_digits) {
                    $customer = Customer::retrieve($user->stripe_id);
                }

                if (!$customer) {
                    $customer = Customer::create([
                        "email" => request('stripeEmail'),
                        "source" => request('stripeToken'),
                    ]);
                    $user->stripe_id = $customer->id;
                    $user->save();
                }

                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => ($defaultPackageData['totalAmount'] + $gotmPackageData['totalAmount']) * 100,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                DB::rollback();

                if ($request->ajax()) {
                    return response()->json([
                        'status' => $e->getMessage()
                    ], 422);
                }

                return redirect()->back()->withErrors(['stripe_error' => $e->getMessage()]);
            }
        } else {
            $elitePackage = true;
            // create elite account
            Session::flash('account_created_elite', __('messages.account_created_elite'));
        }

        // commit transaction if everything went well
        DB::commit();

        if (!$request->ajax() && $elitePackage === false) {
            return redirect()->back();
        }
    }

    public function getNewsAndEvents()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.news_events', compact('local', 'news', 'events'));
    }

    public function postNews(Request $request, $username)
    {
        $user = Auth::guard('local')->user();

        if ($user->news()->count() >= 3) {
            return redirect()->back();
        }

        if ($request->news_flyer == 'on') {
            $validator = Validator::make($request->all(), [
                'news_photo' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'news_title' => 'required',
                'news_duration' => 'required',
                'news_description' => 'required',
                'news_photo' => 'required',
            ]);
        }

        $explodedNewsDuration = explode(' - ', $request->news_duration);
        $from = Carbon::createFromFormat('d/m/Y', $explodedNewsDuration[0]);
        $to = Carbon::createFromFormat('d/m/Y', $explodedNewsDuration[1]);
        $newsDuration = $to->diffInDays($from);

        $total = getEventPrice() + (getEventPrice(true) * $newsDuration);

        if ($validator->passes()) {

            $news = new News;
            $news->news_title = $request->news_title;
            $news->news_description = $request->news_description;
            $news->news_total_amount = $total;
            $news->news_activation_date = $from->format('Y-m-d');
            $news->news_expiry_date = $to->format('Y-m-d');
            $news->news_photo = storeAndGetUploadCareFiles($request->news_photo);

            $user->news()->save($news);

            try {
                $customer = Customer::create([
                    'email' => request('stripeEmailNews'),
                    'source' => request('stripeTokenNews'),
                ]);
                $user->stripe_id = $customer->id;
                $user->save();

                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => $total * 100,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => $e->getMessage()
                ], 422);
            }

            Session::flash('success', __('messages.news_added'));

        } else {
            Session::flash('showNewsModal', true);
            return response()->json([
                'errors' => $validator->getMessageBag()
            ]);
        }
    }

    public function postEvents(Request $request)
    {
        $user = Auth::guard('local')->user();

        if ($user->events()->count() >= 3) {
            return redirect()->back();
        }

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

        $total = getEventPrice() + (getEventPrice(true) * $eventDuration);

        if ($validator->passes()) {

            $event = new Events;
            $event->events_title = $request->events_title;
            $event->events_venue = $request->events_venue;
            $event->events_date = $request->events_date;
            $event->events_description = $request->events_description;
            $event->events_total_amount = $total;
            $event->events_activation_date = $from->format('Y-m-d');
            $event->events_expiry_date = $to->format('Y-m-d');
            $event->events_photo = storeAndGetUploadCareFiles($request->events_photo);
            
            $user->events()->save($event);

            try {
                $customer = Customer::create([
                    'email' => request('stripeEmailEvent'),
                    'source' => request('stripeTokenEvent'),
                ]);
                $user->stripe_id = $customer->id;
                $user->save();

                Charge::create([
                    'customer' => $user->stripe_id,
                    'amount' => $total * 100,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => $e->getMessage()
                ], 422);
            }

            Session::flash('success', __('messages.event_added'));

        } else {
            return response()->json([
                'errors' => $validator->getMessageBag()
            ]);
        }
    }

    public function deleteGirl($username, $private_id)
    {
        $user = Auth::user()->users()->findOrFail($private_id);
        $user->delete();

        return redirect()->back()->with('success', __('messages.girl_removed_success'));
    }
}
