<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\LocalType;
use DB;
use Session;

class LocalProfileController extends Controller
{
    public function getIndex(Request $request)
    {
        $locals = DB::table('locals');
        $types = LocalType::all();

        $orderBy = $request->order_by ? $request->order_by : null;
        $show = $request->show ? $request->show : null;
        $radius = $request->radius ? $request->radius : null;

        if ($radius && is_numeric($radius) && Session::has('lat') && Session::has('lng')) {
            $lat = Session::get('lat');
            $lng = Session::get('lng');
            $locals = Local::nearLatLng($lat, $lng, $radius, $request);
        } else {
            if ($request->has('types')) {
                $locals = $locals->whereIn('locals.local_type_id', $request->types);
            }

            $locals = $locals->where('locals.approved', '=', '1')
            ->where('locals.is_active_d_package', '=', '1')
            ->select('locals.*')
            ->groupBy('locals.username');
        }

        $locals = isset($orderBy) ? $locals->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $locals;

        if (Session::has('locals')) {
            $locals = Session::pull('locals');
        } else {
            $locals = isset($show) ? $locals->paginate($show) : $locals->paginate(9);
        }

        $request->flash();

        return view('pages.local-profile.index', compact('locals', 'currentQueries', 'types'));
    }

    public function getLocal($username)
    {
        $local = Local::username($username)->approved()->first();

        if($local) {
            $entrance = getClubInfo($local->clubEntrance);
            $wellness = getClubInfo($local->clubWellness);
            $food = getClubInfo($local->clubFood);
            $outdoor = getClubInfo($local->clubOutdoor);
            return view('pages.local-profile.single', compact('local' ,'entrance', 'wellness', 'food', 'outdoor'));
        }
    }
}
