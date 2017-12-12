<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\LocalType;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:local');
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
        $types = LocalType::all();
        return view('pages.locals.create', compact('local', 'types'));
    }

    public function postCreate(Request $request)
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
            $user->username = request('username');
            $user->email = request('email');
            if ($request->password) {
                $request->merge(['password' => bcrypt($request->password)]);
            } else {
                $request->merge(['password' => $user->password]);
            }
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
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        Session::flash('success', 'Profile Successfullt Created');
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
            'name' => 'required|max:25',
            'street' => 'required|max:40',
            'city' => 'required|max:30',
            'zip' => 'required|max:10',
            'web' => 'required',
            'phone' => 'required|max:20',
        ]);

        $local = Auth::guard('local')->user();
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
            $nickname = 'nickname_'. $girl->id;
            $girl->nickname = $request->$nickname;
            $girl->photos = storeAndGetUploadCareFiles(request('photos_'. $girl->id));
            $girl->save();
        }
        return redirect()->back()->with('success', 'Data successfully saved.');
    }

    public function postCreateGirls(Request $request)
    {
        $local = Auth::guard('local')->user();
        $local->girls()->create(['nickname' => $request->nickname, 'photos' => storeAndGetUploadCareFiles(request('newPhotos')), 'local_id' => $local->id]);
        return redirect()->back()->with('success', 'Data successfully saved.');
    }
}
