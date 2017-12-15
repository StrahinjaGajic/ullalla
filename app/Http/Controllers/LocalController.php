<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\LocalType;
use App\Models\LocalPackage;
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
        $types = LocalType::all();
        return view('pages.locals.create', compact('local', 'types', 'packages'));
    }

    public function postCreate(Request $request)
    {
        /*
        $this->validate($request, [
            'name' => 'required|max:25',
            'street' => 'required|max:40',
            'city' => 'required|max:30',
            'zip' => 'required|max:10',
            'web' => 'required',
            'phone' => 'required|max:20',
        ]);
*/
        // get working time
        $workingTime = getWorkingTime(
            $request->days,
            $request->available_24_7,
            $request->time_from,
            $request->time_from_m,
            $request->time_to,
            $request->time_to_m
        );

        $defaultPackageInput = request('ullalla_package')[0];
        $defaultPackage = LocalPackage::findOrFail($defaultPackageInput);
        $defaultPackageActivationDateInput = request('default_package_activation_date')[$defaultPackage->id];
        $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
        $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
        if(request('package_duration')[$defaultPackage->id] == 'month'){
            $defaultPackageExpiryDate = $carbonDate->addMonths(1)->format('Y-m-d H:i:s');
        }elseif(request('package_duration')[$defaultPackage->id] == 'year'){
            $defaultPackageExpiryDate = $carbonDate->addYears(1)->format('Y-m-d H:i:s');
        }
        $price = request('package_duration')[$defaultPackage->id]. '_price';
        $totalAmount = (int) filter_var($defaultPackage->$price, FILTER_SANITIZE_NUMBER_INT);

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
            $user->photos = storeAndGetUploadCareFiles(request('photos'));
            $user->videos = storeAndGetUploadCareFiles(request('video'));
            $user->working_time = $workingTime;
            $user->club_entrance_id = setClubInfo('entrance', request('entrance'), request('entrance-free'));
            $user->club_wellness_id = setClubInfo('wellness', request('wellness'), request('wellness-free'));
            $user->club_food_id = setClubInfo('food', request('food'), request('food-free'));
            $user->club_outdoor_id = setClubInfo('outdoor', request('outdoor'), request('outdoor-free'));
            $user->package1_id = $defaultPackage->id;
            $user->is_active_d_package = 1;
            $user->package1_duration = request('package_duration')[$defaultPackage->id];
            $user->package1_activation_date = $defaultPackageActivationDate;
            $user->package1_expiry_date = $defaultPackageExpiryDate;
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
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
        Session::flash('account_created', __('messages.account_created_but_not_approved'));
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
            're-password' => 'required_with:password|same:password',
            'name' => 'required|max:25',
            'street' => 'required|max:40',
            'city' => 'required|max:30',
            'zip' => 'required|max:10',
            'web' => 'required',
            'phone' => 'required|max:20',
        ]);

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

        $local->save();

        return redirect()->back()->with('success', 'Contact successfully saved.');
    }

    public function getGallery()
    {

        $local = Auth::guard('local')->user();

        return view('pages.locals.gallery', compact('local'));
    }

    public function postGallery(Request $request)
    {
        $local = Auth::guard('local')->user();
        $local->photos = storeAndGetUploadCareFiles(request('photos'));
        $request->merge(['photos' => storeAndGetUploadCareFiles(request('photos'))]);
        $request->merge(['photos' => substr($request->photos, -2, 1)]);
        $request->merge(['photos' => (int) $request->photos]);
        $this->validate($request, [
            'photos' => 'numeric|min:4',
        ]);

        $local->photo = storeAndGetUploadCareFiles(request('photo'));
        $local->videos = storeAndGetUploadCareFiles(request('video'));
        $local->save();

        return redirect()->back()->with('success', 'Gallery successfully updated.');
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

        return redirect()->back()->with('success', 'Work time successfully updated.');
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

        return redirect()->back()->with('success', 'Data successfully saved.');
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

        return redirect()->back()->with('success', 'Data successfully saved.');
    }

    public function getGirls()
    {
        $local = Auth::guard('local')->user();
        return view('pages.locals.girls', compact('local'));
    }

    public function postGirls(Request $request)
    {
        $local = Auth::guard('local')->user();
        foreach($local->girls as $girl){

            $photos = storeAndGetUploadCareFiles(request('photos_'. $girl->id));
            $reqPhotos = (int) substr($photos, -2, 1);
            $request->merge(['photos_'. $girl->id => $reqPhotos]);
            $this->validate($request, [
                'nickname_'. $girl->id => 'required|min:4|max:20',
                'photos_'. $girl->id => 'numeric|min:4',
            ]);
            $nickname = 'nickname_'. $girl->id;
            $girl->nickname = $request->$nickname;
            $girl->photos = $photos;
            $girl->save();
        }
        return redirect()->back()->with('success', 'Data successfully saved.');
    }

    public function postCreateGirls(Request $request)
    {
        $local = Auth::guard('local')->user();
        $photos = storeAndGetUploadCareFiles(request('newPhotos'));
        $request->merge(['newPhotos' => storeAndGetUploadCareFiles(request('newPhotos'))]);
        $request->merge(['newPhotos' => substr($request->photos, -2, 1)]);
        $request->merge(['newPhotos' => (int) $request->photos]);
        $this->validate($request, [
            'nickname' => 'required|min:4|max:20',
            'newPhotos' => 'numeric|min:4',
        ]);
        $local->girls()->create(['nickname' => $request->nickname, 'photos' => $photos, 'local_id' => $local->id]);
        return redirect()->back()->with('success', 'Data successfully saved.');
    }

    public function getPackages()
    {
        $user = Auth::guard('local')->user();
        $packages = LocalPackage::all();

        $showDefaultPackages = false;

        $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiryLocal($user->package1_duration)[0])->format('Y-m-d');

        if (Carbon::now() >= $dayFromWhichDefaultPackagesShouldBeShown) {
            $showDefaultPackages = true;
        }
        return view('pages.locals.packages', compact('user', 'packages', 'showDefaultPackages'));
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
                    $defaultPackageActivationDateInput = $defaultPackageActivationDateInput[$defaultPackage->id];
                    // format default packages dates with carbon
                    $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
                    $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
                    if(request('package_duration')[$defaultPackage->id] == 'month'){
                        $defaultPackageExpiryDate = $carbonDate->addMonths(1)->format('Y-m-d H:i:s');
                    }elseif(request('package_duration')[$defaultPackage->id] == 'year'){
                        $defaultPackageExpiryDate = $carbonDate->addYears(1)->format('Y-m-d H:i:s');
                    }
                    $price = request('package_duration')[$defaultPackage->id]. '_price';
                    $totalAmount += (int) filter_var($defaultPackage->$price, FILTER_SANITIZE_NUMBER_INT);

                    $user->package1_id = $defaultPackage->id;
                    $user->is_active_d_package = 1;
                    $user->package1_duration = request('package_duration')[$defaultPackage->id];
                    $user->package1_activation_date = $defaultPackageActivationDate;
                    $user->package1_expiry_date = $defaultPackageExpiryDate;
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


            // charge a customer
            Charge::create([
                'customer' => $user->stripe_id,
                'amount' => $totalAmount * 100,
                'currency' => 'chf',
            ]);

            // approve the user
            $user->approved = '1';
            $user->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 422);
        }

        Session::flash('success', __('messages.success_changes_saved'));
    }
}
