<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Charts;
use Session;
use Carbon\Carbon;
use App\Models\Local;
use App\Models\LocalType;
use App\Models\BannerPage;
use App\Models\VisitorDate;
use Illuminate\Http\Request;
use App\Models\VisitorDateUser;


class LocalProfileController extends Controller
{
    public function getIndex(Request $request)
    {
        $types = LocalType::all();
        $smallBanners = BannerPage::getByPageId(1, 3, true)->take(4)->get();

        $orderBy = $request->order_by ? $request->order_by : null;
        $mode = $request->mode == 'list' ? 'list' : 'grid';
        $show = $request->show ? $request->show : 9;
        $radius = $request->radius ? $request->radius : null;

        if ($radius && is_numeric($radius) && Session::has('lat') && Session::has('lng')) {
            $lat = Session::get('lat');
            $lng = Session::get('lng');
            $locals = Local::nearLatLng($lat, $lng, $radius, $request);
        } else {
            $locals = DB::table('locals');

            if ($request->has('types')) {
                $locals = $locals->whereIn('locals.local_type_id', $request->types);
            }

            $locals = $locals->where('locals.is_active_d_package', '=', '1')
            ->select('locals.*')
            ->groupBy('locals.username');
        }

        $locals = isset($orderBy) ? $locals->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $locals;

        if (Session::has('locals')) {
            $locals = Session::pull('locals');
        } else {
            $locals = $locals->paginate($show);
        }

        $request->flash();

        return view('pages.local-profile.index', compact('locals', 'currentQueries', 'types', 'mode', 'smallBanners'));
    }

    public function getLocal($username)
    {
        $local = Local::username($username)->first();

        if(Auth::guard('local')->user() && $username != Auth::guard('local')->user()->username){
            $visits = VisitorDateUser::join('visitor_dates', 'visitor_dates.id', '=', 'visitor_date_user.visitor_date_id')->select('visitor_dates.id AS date_id', 'visitor_dates.date', 'visitor_date_user.*')->get();

            $checkForDate = false;
            foreach($visits as $visit){
                if(date('d-m-Y', strtotime($visit->date)) == date('d-m-Y') && $visit->local_id == $local->id){
                    $visit->visitors = $visit->visitors + 1;
                    $visit->save();
                    $checkForDate = true;
                }
            }

            if(!$checkForDate){
                $dates = VisitorDate::all();
                $check = false;
                foreach($dates as $date){
                    if(date('d-m-Y', strtotime($date->date)) == date('d-m-Y')){
                        $check = true;
                    }
                }
                if(!$check) {
                    $date = new VisitorDate;
                    $date->date = Carbon::now();
                    $date->save();
                }

                $visit = new VisitorDateUser;
                $visit->visitor_date_id = $date->id;
                $visit->local_id = $local->id;
                $visit->visitors = 1;
                $visit->active = 0;
                $visit->save();
            }
        }
        if(Auth::guard('local')->user() && $username == Auth::guard('local')->user()->username){
            $user = Local::username($username)->first();
            $values_month = [];
            $dates_month = [];
            $num = 0;
            foreach ($user->visitors as $visitor) {
                if ($visitor->pivot->active) {
                    $values_month[$num] = $visitor->pivot->visitors;
                    $dates_month[$num] = date("d-m", strtotime($visitor->date));
                    $num++;
                }
            }

            $chart_month = Charts::multi('bar', 'highcharts')
                ->title(__('functions.visitors'))
                ->dimensions(0, 400)
                ->template("highcharts")
                ->dataset(__('functions.visitors'), $values_month)
                ->labels($dates_month);

            if($user->year_visitors) {
                $values_year = [];
                $dates_year = [];
                $num = 0;
                foreach (explode(', ', $user->year_visitors) as $visitor) {
                    $visitor = explode(':', $visitor);
                    $values_year[$num] = $visitor[1];
                    $dates_year[$num] = __('global.' . date("F", strtotime($visitor[0])));
                    $num++;
                }
                $chart_year = Charts::multi('bar', 'highcharts')
                    ->title(__('functions.visitors'))
                    ->dimensions(0, 400)
                    ->template("highcharts")
                    ->dataset(__('functions.visitors'), $values_year)
                    ->labels($dates_year);
            }
        }

        if($local) {
            $entrance = getClubInfo($local->clubEntrance);
            $wellness = getClubInfo($local->clubWellness);
            $food = getClubInfo($local->clubFood);
            $outdoor = getClubInfo($local->clubOutdoor);
            return view('pages.local-profile.single', compact('local' ,'entrance', 'wellness', 'food', 'outdoor', 'chart_month', 'chart_year'));
        }
    }

    public function getLocalRadius(Request $request)
    {
        if ($request->ajax()) {
            $url = urldecode(route('locals', $request->query(), false));
            return response()->json([
                'url' => $url
            ]);
        }
    }
}
