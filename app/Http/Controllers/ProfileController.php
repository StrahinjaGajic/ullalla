<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Price;
use App\Models\Banner;
use App\Models\Canton;
use App\Models\Service;
use App\Models\Country;
use App\Models\Package;
use App\Models\BannerSize;
use App\Models\BannerPage;
use App\Rules\OlderThanRule;
use Illuminate\Http\Request;
use App\Models\ContactOption;
use App\Models\ServiceOption;
use App\Models\SpokenLanguage;
use App\Models\PageBannerSize;
use Stripe\{Charge, Customer};

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('package.expiry', ['except' => ['getPackages', 'postPackages', 'getCreate', 'postCreate', 'postNewPrice', 'deletePrice']]);
        $this->middleware('has_package', [
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
        $this->middleware('not_has_package', [
            'except' => [
                'getCreate', 'postCreate', 'postNewPrice', 'deletePrice'
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

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'nickname' => 'required',
            'age' => 'required|numeric|older_than:18',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'sex' => 'required',
            'sex_orientation' => 'required',
            'intimate' => 'required',
            'alcohol' => 'required',
            'smoker' => 'required',
            'about_me' => 'required|max:200',
            'photos' => 'numeric|min:4|max:9',
            'mobile' => 'required|numeric|max:20',
            'phone' => 'required|numeric|max:20',
            'email' => 'required|email',
            'skype_name' => 'required_with:contact_options.3,on',
            'website' => 'url',
        ], [
            'skype_name.required_with' => __('validation.skype_required'),
        ]);

        // define inputs
        $defaultPackageInput = request('ullalla_package')[0];
        $monthGirlPackageInput = request('ullalla_package_month_girl');

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

        // $result = DB::transaction(function () use ($totalAmount, $defaultPackageInput, $monthGirlPackageInput, $workingTime) {

        // get default package obj and activation date input
        $defaultPackage = Package::findOrFail($defaultPackageInput);
        $defaultPackageActivationDateInput = request('default_package_activation_date')[$defaultPackage->id];
        // format default packages dates with carbon
        $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
        $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
        $defaultPackageExpiryDate = $carbonDate->addDays(daysToAddToExpiry($defaultPackage->id))->format('Y-m-d H:i:s');

        if ($monthGirlPackageInput) {
            $monthGirlPackage = Package::findOrFail($monthGirlPackageInput[0]);
            $monthGirlActivationDateInput = request('month_girl_package_activation_date')[$monthGirlPackage->id];
            // format dates with carbon
            $carbonDate = Carbon::parse($monthGirlActivationDateInput);
            $monthGirlActivationDate = $carbonDate->format('Y-m-d H:i:s');
            $monthGirlExpiryDate = $carbonDate->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');
        }

        // calculate the total amount
        $totalAmount = (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        if (isset($monthGirlPackage)) {
            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
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

        try {
            $user = Auth::user();
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
            $user->package1_id = $defaultPackage->id;
            $user->is_active_d_package = 1;
            $user->package1_activation_date = $defaultPackageActivationDate;
            $user->package1_expiry_date = $defaultPackageExpiryDate;
            if (isset($monthGirlPackage)) {
                $user->package2_id = $monthGirlPackage->id;
                $user->is_active_gotm_package = 1;
                $user->package2_activation_date = $monthGirlActivationDate;
                $user->package2_expiry_date = $monthGirlExpiryDate;
            }
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
                'error' => $e->getMessage()
            ]);
        }

        // stripe
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

        //     return true;
        // });

        // if ($result !== true) {
        //     return redirect('/')->with('error', 'There was an error');
        // }

        Session::flash('account_created', __('messages.account_created'));
    }

    public function getBio()
    {
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();
        $user = Auth::user();

        return view('pages.profile.bio', compact('packages', 'cantons', 'countries', 'services', 'user'));
    }

    public function postBio(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'age' => ['required', 'numeric', new OlderThanRule],
        ]);

        $user = Auth::user();
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

    public function getAbout()
    {
        $user = Auth::user();

        return view('pages.profile.about', compact('user'));
    }

    public function postAbout()
    {
        $user = Auth::user();
        $user->about_me = request('about_me');
        $user->save();

        return redirect()->back()->with('success', __('messages.success_changes_saved'));
    }

    public function getGallery()
    {
        $user = Auth::user();

        return view('pages.profile.gallery', compact('user'));
    }

    public function postGallery(Request $request)
    {
        $user = Auth::user();
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

    public function getServices()
    {
        $user = Auth::user();
        $services = Service::all();
        $serviceOptions = ServiceOption::all();

        return view('pages.profile.services', compact('user', 'services', 'serviceOptions'));
    }

    public function postServices()
    {
        $user = Auth::user();
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

    public function getLanguages()
    {
        $user = Auth::user();
        $spokenLanguages = SpokenLanguage::all();

        return view('pages.profile.languages', compact('user', 'spokenLanguages'));
    }

    public function postLanguages(Request $request)
    {
        $user = Auth::user();

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
        $dayFromWhichGotmPackagesShouldBeShown = null;

        $scheduledDefaultPackage = $user->scheduled_default_package;
        $scheduledGotmPackage = $user->scheduled_gotm_package;

        $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiry($user->package1_id)[0])->format('Y-m-d');
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

        $totalAmount = 0;
        $defaultPackageActivationDateInput = request('default_package_activation_date');
        $monthGirlActivationDateInput = request('month_girl_package_activation_date');

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
                    $defaultPackageActivationDateInput = $defaultPackageActivationDateInput[$defaultPackage->id];
                    $currentExpiryDateParsed = Carbon::parse($user->package1_expiry_date);
                    $activationDateInputParsed = Carbon::parse($defaultPackageActivationDateInput);

                    // format default packages dates with carbon
                    $defaultPackageActivationDate = $activationDateInputParsed->format('Y-m-d H:i:s');
                    $defaultPackageExpiryDate = $activationDateInputParsed->addDays(daysToAddToExpiry($defaultPackage->id))->format('Y-m-d H:i:s');

                    $totalAmount += (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                    // check if we should schedule the package or not
                    if (Carbon::now() <= $currentExpiryDateParsed) {
                        $string = $defaultPackage->id . '&|' . $defaultPackageActivationDate . '&|' . $defaultPackageExpiryDate . '&|' . $totalAmount;
                        $user->scheduled_default_package = $string;
                        $user->save();

                        Session::flash('success', __('messages.scheduled_default_package'));

                        return response()->json([
                            'success' => true
                        ]);
                    } else {
                        $user->package1_id = $defaultPackage->id;
                        $user->is_active_d_package = 1;
                        $user->package1_activation_date = $defaultPackageActivationDate;
                        $user->package1_expiry_date = $defaultPackageExpiryDate;
                    }                    
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

        try {
            $customer = Customer::create([
                'email' => request('stripeEmail'),
                'source' => request('stripeToken'),
            ]);
            $user->stripe_id = $customer->id;
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
    }

    public function getBanners()
    {
        $user = Auth::user();

        return view('pages.profile.banners.index', compact('user', 'pages', 'bannerSizes'));
    }

    public function getCreateBanners()
    {
        $user = Auth::user();
        $pages = Page::with('banner_sizes')->get();
        $bannerSizes = BannerSize::with('pages')->get();

        return view('pages.profile.banners.create', compact('user', 'pages', 'bannerSizes'));
    }

    public function postBanners(Request $request)
    {
        $user = Auth::user();

        $data = getBannerTotalAmountAndDataToSync($request);
        $total = $data['total'];

        $perDay = 'price_per_week, price_per_month';
        $perMonth = 'price_per_day, price_per_week';
        $perWeek = 'price_per_day, price_per_month';

        $field = '';
        foreach ($request->all() as $field => $value) {
            if (strpos($field, 'price_per') !== false) {
                $field = $field;
                break;
            }
        }

        // get price per time input, check it and define validation rules to use them later in validator
        if ($field == 'price_per_day') {
            $perDay = 'price_per_day, price_per_month';
        } elseif ($field == 'price_per_week') {
            $perDay = 'price_per_week, price_per_day';
            $perMonth = 'price_per_week, price_per_month';
        } elseif ($field == 'price_per_month') {
            $perDay = 'price_per_month, price_per_day';
            $perMonth = 'price_per_month, price_per_week';
        }

        if ($request->banner_flyer == 'on') {
            $validator = Validator::make($request->all(), [
                'price_per_day' => 'required_without_all:' . $perMonth,
                'price_per_week' => 'required_without_all:' . $perDay,
                'price_per_month' => 'required_without_all:' . $perDay,
                'banner_photo' => 'required',
                'banner_url' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'price_per_day' => 'required_without_all:' . $perMonth,
                'price_per_week' => 'required_without_all:' . $perDay,
                'price_per_month' => 'required_without_all:' . $perDay,
                'banner_description' => 'required',
                'banner_photo' => 'required',
                'banner_url' => 'required',
            ]);
        }

        if ($validator->passes()) {

            $banner = new Banner;
            $banner->banner_total_amount = $total;
            $banner->banner_url = $request->banner_url;
            $banner->banner_photo = $request->banner_photo;
            $banner->user_id = $user->id;
            $banner->save();

            foreach ($data['syncedData'] as $pageId => $sizes) {
                foreach ($sizes as $size) {
                    $bannerPage = new BannerPage;
                    $bannerPage->banner_id = $banner->id;
                    $bannerPage->page_id = $pageId;
                    $bannerPage->banner_size_id = $size['banner_size_id'];
                    $bannerPage->save();
                }
            }

            try {
                $customer = Customer::retrieve($user->stripe_id);

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
                    'amount' => $total * 100,
                    'currency' => 'chf',
                ]);
            } catch (\Exception $e) {
                if ($request->ajax()) {
                    return response()->json([
                        'status' => $e->getMessage()
                    ], 422);
                }

                return redirect()->back()->withErrors(['stripe_error' => $e->getMessage()]);
            }

            Session::flash('success', __('messages.banner_requested_success'));

        } else {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($validator->getMessageBag());
        }
    }

    public function postNewPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_duration' => 'required|numeric',
            'service_price' => 'required|numeric',
            'price_type' => 'required',
            'service_price_unit' => 'required',
            'service_price_currency' => 'required',
        ]);

        $user = Auth::user();

        if ($request->ajax()) {
            if ($validator->passes()) {
                // insert new price
                $price = new Price;
                $price->user_id = $user->id;
                $price->service_duration = $request->service_duration;
                $price->service_price = $request->service_price;
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

    public function getCard()
    {   
        $user = Auth::user();
        return view('pages.profile.add_card', compact('user'));
    }

    public function postCard()
    {   
        $user = Auth::user();

        try {
            $customer = Customer::retrieve($user->stripe_id); // stored in your application
            $customer->email = $user->email; // obtained with Checkout
            $customer->source = request('stripeToken'); // obtained with Checkout
            $customer->save();

            Session::flash('success', 'Your card details have been updated!');

            return redirect()->back();

            // return response()->json([
            //     'customer' => $customer
            // ]);
        } catch(\Error\Card $e) {

            // Use the variable $error to save any errors
            // To be displayed to the customer later in the page
            $body = $e->getJsonBody();
            $err  = $body['error'];
            $error = $err['message'];
        }
        $user = Auth::user();
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
