<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\LocalType;
use DB;

class LocalProfileController extends Controller
{
    public function getIndex(Request $request)
    {
        $locals = DB::table('locals');
        $types = LocalType::all();
        $orderBy = $request->order_by ? $request->order_by : null;
        $show = $request->show ? $request->show : null;


        if ($request->has('types')) {
            $locals = $locals->whereIn('locals.local_type_id', $request->types);
        }

        $locals = $locals->where('locals.approved', '=', '1')
            ->select('locals.*')
            ->groupBy('locals.username');
        $locals = isset($orderBy) ? $locals->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $locals;
        $locals = isset($show) ? $locals->paginate($show) : $locals->paginate(9);


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
