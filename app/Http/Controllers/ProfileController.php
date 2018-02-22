<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Price;
use App\Models\Canton;
use App\Models\Service;
use App\Models\Country;
use App\Models\Package;
use App\Rules\OlderThanRule;
use Illuminate\Http\Request;
use App\Models\ContactOption;
use App\Models\ServiceOption;
use App\Models\SpokenLanguage;
use Stripe\{Charge, Customer};

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,local');

        $this->middleware('has_profile', [
            'only' => [
                'getCreate',
                'postCreate'
            ]
        ]);

        $this->middleware('package.expiry', [
            'except' => [
                'getPackages',
                'postPackages',
                'getCreate',
                'postCreate',
                'postNewPrice',
                'deletePrice'
            ]
        ]);
        $this->middleware('has_no_profile', [
            'except' => [
                'getCreate', 
                'postCreate', 
                'postNewPrice', 
                'deletePrice'
            ]
        ]);
    }

    public function getCreate()
    {
        $user = Auth::user();
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();
        $contactOptions = ContactOption::all();
        $serviceOptions = ServiceOption::all();
        $spokenLanguages = SpokenLanguage::all();
        $prices = Price::where('user_id', $user->id)->get();

        return view('pages.profile.create', compact('packages', 'cantons', 'countries', 'services', 'user', 'prices', 'contactOptions', 'serviceOptions', 'spokenLanguages'));
    }

    public function postCreate(Request $request)
    {
        $uploadedPhotos = storeAndGetUploadCareFiles(request('photos'));
        $inputPhotos = request('photos');

        // get the number of photos
        $request->merge(['photos' => (int) substr($inputPhotos, -2, 1)]);

//        $this->validate($request, [
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'nickname' => 'required',
//            'age' => ['required', 'numeric', new OlderThanRule'],
//            'height' => 'required|numeric',
//            'weight' => 'required|numeric',
//            'sex' => 'required',
//            'sex_orientation' => 'required',
//            'intimate' => 'required',
//            'alcohol' => 'required',
//            'smoker' => 'required',
//            'about_me' => 'required',
//            'photos' => 'numeric|min:4|max:9',
//            'mobile' => 'required|numeric|max:20',
//            'phone' => 'required|numeric|max:20',
//            'email' => 'required|email',
//            'skype_name' => 'required_with:contact_options.3,on',
//            'website' => 'url',
//        ], [
//            'skype_name.required_with' => __('validation.skype_required'),
//        ]);

        // get working time
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

        $incallType = null;
        $outcallType = null;
        $incallOption = request('incall_option');
        $outcallOption = request('outcall_option');

        if ($incallOption) {
            if ($incallOption != 'define_yourself') {
                $incallType = array_search_reverse($incallOption, getIncallOptions());
            } elseif (request('incall_define_yourself')) {
                $incallType = 'define_yourself' . '|' . request('incall_define_yourself');
            }
        }

        if ($outcallOption) {
            if ($outcallOption != 'define_yourself') {
                $outcallType = array_search_reverse($outcallOption, getOutcallOptions());
            } elseif(request('outcall_define_yourself')) {
                $outcallType = 'define_yourself' . '|' . request('outcall_define_yourself');
            }
        }

        try {
            $user = Auth::user();
            $user->has_profile = 1;
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->nickname = request('nickname');
            $user->age = request('age');
            $user->country_id = request('nationality_id');
            $user->sex = request('sex');
            $user->sex_orientation = request('sex_orientation');
            $user->height = request('height');
            $user->weight = request('weight');
            $user->type = request('ancestry');
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
            $user->email = request('email');
            $user->website = request('website');
            $user->phone = request('phone');
            $user->mobile = request('mobile');
            $user->sms_notifications = request('sms_notifications') ? '1' : '0';
            $user->prefered_contact_option = request('prefered_contact_option');
            $user->skype_name = request('skype_name');
            $user->no_withheld_numbers = request('no_withheld_numbers') ? '1' : '0';
            $user->canton_id = request('canton');
            $user->city = request('city');
            $user->zip_code = request('zip_code');
            $user->address = request('address');
            $user->club_name = request('club_name');
            $user->incall_type = $incallType;
            $user->outcall_type = $outcallType;
            $user->working_time = $workingTime;
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
            $user->service_options()->sync(request('service_options'));
            $user->contact_options()->sync(request('contact_options'));
            $user->spoken_languages()->sync($syncData);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'There was a problem creating your profile.'
            ], 422);
        }

        return redirect('/')->with('account_created', __('messages.account_created'));
    }

    public function getBio($private_id)
    {
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();

        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        return view('pages.profile.bio', compact('packages', 'cantons', 'countries', 'services', 'user'));
    }

    public function postBio(Request $request, $private_id)
    {
        $this->validate($request, [
            'nickname' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => ['required', 'numeric', new OlderThanRule],
        ]);

        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $user->nickname = $request->nickname;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country_id = Country::where('id', $request->nationality)->value('id');
        $user->age = $request->age;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->sex = checkIfItemExists(getSexes(), $request->sex);
        $user->sex_orientation = checkIfItemExists(getSexOrientations(), $request->sex_orientation);
        $user->type = checkIfItemExists(getTypes(), $request->type);
        $user->figure = checkIfItemExists(getFigures(), $request->figure);
        $user->breast_size = checkIfItemExists(getBreastSizes(), $request->breast_size);
        $user->eye_color = checkIfItemExists(getEyeColors(), $request->eye_color);
        $user->hair_color = checkIfItemExists(getHairColors(), $request->hair_color);
        $user->tattoos = checkIfItemExists(getAnswers(), $request->tattoos);
        $user->piercings = checkIfItemExists(getAnswers(), $request->piercings);
        $user->body_hair = checkIfItemExists(getShaveOptions(), $request->body_hair);
        $user->intimate = checkIfItemExists(getShaveOptions(), $request->intimate);
        $user->smoker = checkIfItemExists(getAnswers(), $request->smoker);
        $user->alcohol = checkIfItemExists(getAnswers(), $request->alcohol);

        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getAbout($private_id)
    {
        if (Auth::guard('local')->check()) {
            Session::put('private_id', $private_id);
            $user = Auth::guard('local')->user()->users()->findOrFail(Session::get('private_id'));
        } else {
            $user = Auth::user();
        }

        return view('pages.profile.about', compact('user'));
    }

    public function postAbout($private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $user->about_me = request('about_me');
        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getGallery($private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        return view('pages.profile.gallery', compact('user'));
    }

    public function postGallery(Request $request, $private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $uploadedPhotos = storeAndGetUploadCareFiles(request('photos'));
        $inputPhotos = request('photos');

        // get the number of photos
        $request->merge(['photos' => (int) substr($inputPhotos, -2, 1)]);

        $this->validate($request, [
            'photos' => 'numeric|min:4|max:9',
        ]);

        $user->photos = $uploadedPhotos ? $inputPhotos : null;
        $user->videos = storeAndGetUploadCareFiles(request('video'));
        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getContact()
    {
        $user = Auth::user();
        $contactOptions = ContactOption::all();

        return view('pages.profile.contact', compact('user', 'contactOptions'));
    }

    public function postContact(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'mobile' => 'required',
            'skype_name' => 'required_with:contact_options.3,on'
        ], [
            'skype_name.required_with' => __('validation.skype_required'),
        ]);

        $user->phone = request('phone');
        $user->mobile = request('mobile');
        $user->sms_notifications = request('sms_notifications') ? '1' : '0';
        $user->website = request('website');
        $user->prefered_contact_option = request('prefered_contact_option');
        $user->skype_name = request('contact_options') && in_array('3', request('contact_options')) ? request('skype_name') : NULL;
        $user->no_withheld_numbers = request('no_withheld_numbers') ? '1' : '0';
        $user->save();

        $user->contact_options()->sync(request('contact_options'));

        $request->flash();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getServices($private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $services = Service::all();
        $serviceOptions = ServiceOption::all();

        return view('pages.profile.services', compact('user', 'services', 'serviceOptions'));
    }

    public function postServices($private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $user->services()->sync(request('services'));
        $user->service_options()->sync(request('service_options'));

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getWorkplace()
    {
        $user = Auth::user();
        $cantons = Canton::all();

        return view('pages.profile.workplace', compact('user', 'cantons'));
    }

    public function postWorkplace()
    {
        $user = Auth::user();
        $address = request('address');
        $city = request('city');
        $lat = null;
        $lng = null;
        $fullAddress = $address && $city ? $address . ', ' . $city : null;

        if ($fullAddress) {
            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($fullAddress).'&sensor=false');
            $geo = json_decode($geo, true);

            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $lat = $geo['results'][0]['geometry']['location']['lat'];
                $lng = $geo['results'][0]['geometry']['location']['lng'];
            }
        }

        $incallType = null;
        $outcallType = null;
        $incallOption = request('incall_option');
        $outcallOption = request('outcall_option');

        if ($incallOption) {
            if ($incallOption != 'define_yourself') {
                $incallType = array_search_reverse($incallOption, getIncallOptions());
            } elseif (request('incall_define_yourself')) {
                $incallType = 'define_yourself' . '|' . request('incall_define_yourself');
            }
        }

        if ($outcallOption) {
            if ($outcallOption != 'define_yourself') {
                $outcallType = array_search_reverse($outcallOption, getOutcallOptions());
            } elseif(request('outcall_define_yourself')) {
                $outcallType = 'define_yourself' . '|' . request('outcall_define_yourself');
            }
        }

        $user->canton_id = request('canton');
        $user->city = request('city');
        $user->address = request('address');
        $user->zip_code = request('zip_code');
        $user->club_name = request('club_name');
        $user->lat = $lat;
        $user->lng = $lng;
        $user->incall_type = $incallType;
        $user->outcall_type = $outcallType;
        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getWorkingTimes()
    {
        $user = Auth::user();

        return view('pages.profile.working_time', compact('user'));
    }

    public function postWorkingTimes(Request $request)
    {
        $user = Auth::user();
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

        $user->working_time = $workingTime;
        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getLanguages($private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        $spokenLanguages = SpokenLanguage::all();

        return view('pages.profile.languages', compact('user', 'spokenLanguages'));
    }

    public function postLanguages(Request $request, $private_id)
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user()->users()->findOrFail($private_id);
        } else {
            $user = Auth::user();
        }

        // define languages input
        $spokenLanguages = array_filter(request('spoken_language'), function($value) { return $value != '0' && $value != null; });

        // define levels
        $levels = array_map(function($languageLevel) {
            return ['language_level' => $languageLevel];
        }, $spokenLanguages);

        // get combined data
        $syncData = array_combine(array_keys($spokenLanguages), $levels);

        // sync data and save
        $user->spoken_languages()->sync($syncData);

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getPrices()
    {
        $user = Auth::user();

        return view('pages.profile.prices', compact('user'));
    }

    public function getPackages()
    {
        $user = Auth::user();
        $packages = Package::all();

        $showDefaultPackages = false;
        $showGotmPackages = false;
        $dayFromWhichDefaultPackagesShouldBeShown = null;
        $dayFromWhichGotmPackagesShouldBeShown = null;

        $scheduledDefaultPackage = $user->scheduled_default_package;
        $scheduledGotmPackage = $user->scheduled_gotm_package;

        if ($user->package1_id) {
            $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiry($user->package1_id)[0])->format('Y-m-d');
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

        return view('pages.profile.packages', 
            compact(
                'user', 
                'packages', 
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
        $user = Auth::user();
        $defaultPackageData = ['needCharge' => false, 'totalAmount' => 0];
        $gotmPackageData = ['needCharge' => false, 'totalAmount' => 0];
        $totalAmount = 0;

        $defaultPackageActivationDateInput = request('default_package_activation_date');
        $monthGirlActivationDateInput = request('month_girl_package_activation_date');

        if ($monthGirlActivationDateInput && !$defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package_month_girl' => 'required'
            ], [
                __('validation.gotm_package_required')
            ]);
            // check if validator passed or not
            if ($validator->passes()) {
                // insert gotm package
                $gotmPackageData = User::insertPackage($request, $user, $monthGirlActivationDateInput, $totalAmount, true);
                if ($gotmPackageData['scheduled'] === true) {
                    // only default package scheduled
                    return redirect()->back()->with('success_scheduled', __('messages.scheduled_gotm_package'));
                }

                // continue to with payment
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
                $defaultPackageData = User::insertPackage($request, $user, $defaultPackageActivationDateInput, $totalAmount);
                // insert gotm package
                if ($monthGirlActivationDateInput) {
                    $gotmPackageData = User::insertPackage($request, $user, $monthGirlActivationDateInput, $totalAmount, true);
                    if ($gotmPackageData['scheduled'] && !$defaultPackageData['scheduled']) {
                        // only gotm package scheduled
                        Session::flash('success_scheduled', __('messages.scheduled_gotm_package'));                        
                    } elseif ($gotmPackageData['scheduled'] && $defaultPackageData['scheduled']) {
                        // both packages scheduled
                        return redirect()->back()->with('success_scheduled', __('messages.scheduled_packages'));
                    }
                }

                if ($defaultPackageData['scheduled']) {
                        Session::flash('success_scheduled', __('messages.scheduled_default_package'));
                    if (!$gotmPackageData['needCharge']) {
                        return redirect()->back();
                    }
                }

                // continue to with payment

            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'errors' => $validator->getMessageBag()
                    ]);
                }

                return redirect()->back()->withErrors($validator->getMessageBag());
            }
        }

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

        DB::commit();

        if ($defaultPackageData['needCharge']) {
            if ($gotmPackageData['needCharge']) {
                Session::flash('success_gotm_package_updated', __('messages.gotm_package_successfully_saved'));
            }
            Session::flash('success_d_package_updated', __('messages.d_package_successfully_saved'));
        } else if ($gotmPackageData['needCharge']) {
            Session::flash('success_gotm_package_updated', __('messages.gotm_package_successfully_saved'));
        }

        if (!$request->ajax()) {
            return redirect()->back();
        }
    }

    public function postNewPrice(Request $request)
    {
        $onDemand = $request->on_demand;

        if ($onDemand == 'true') {
            $validator = Validator::make($request->all(), [
                'service_duration' => 'required|numeric',
                'price_type' => 'required',
                'service_price_unit' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'service_duration' => 'required|numeric',
                'service_price' => 'required|numeric',
                'service_price_currency' => 'required',
                'price_type' => 'required',
                'service_price_unit' => 'required',
            ]);
        }

        $onDemand = $onDemand == 'true' ? 1 : NULL;

        $user = Auth::user();

        if ($request->ajax()) {
            if ($validator->passes()) {
                // insert new price
                $price = new Price;
                $price->user_id = $user->id;
                $price->service_duration = $request->service_duration;
                $price->service_price = $request->service_price;
                $price->on_demand = $onDemand;
                $price->price_type = $request->price_type;
                $price->service_price_currency = $request->service_price_currency;
                $price->service_price_unit = $request->service_price_unit;
                $price->save();

                return response()->json([
                    'success' => true,
                    'user' => $user->id,
                    'newPriceID' => $price->id,
                    'serviceDuration' => $price->service_duration,
                    'servicePrice' => $price->service_price,
                    'onDemand' => $price->on_demand == 1 ? 'On Demand' : NULL,
                    'priceType' => $price->price_type,
                    'servicePriceUnit' => trans_choice('fields.' . $price->service_price_unit, $price->service_duration),
                    'servicePriceCurrency' => $price->service_price_currency,
                ]);
            } else {
                return response()->json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
        }
    }

    public function deletePrice(Request $request)
    {
        $user = Auth::user();

        // find price
        $price = Price::where([
            ['id', $request->price_id],
            ['user_id', $user->id]
        ])->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return redirect()->back();
        }
    }
}
