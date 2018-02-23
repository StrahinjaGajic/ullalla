<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorDateUser;
use App\Models\VisitorDate;
use App\Models\User;
use App\Models\Local;

class MakeYearlyVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ullalla:make-yearly-visitors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make yearly visitors';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(date('m') == "01"){
            $users = User::all();
            foreach($users as $user){
                $user->year_visitors = "";
                $user->save();
            }
            $locals = Local::all();
            foreach($locals as $local){
                $local->year_visitors = "";
                $local->save();
            }
        }

        $visits = VisitorDateUser::join('visitor_dates', 'visitor_dates.id', '=', 'visitor_date_user.visitor_date_id')->select('visitor_dates.id AS date_id', 'visitor_dates.date', 'visitor_date_user.*')->get();

        foreach($visits as $visit){
            if(date('m-Y', strtotime($visit->date)) == date('m-Y')){
                if($visit->user_id){
                    $user = User::find($visit->user_id);
                    $insert = false;
                    $visitorFinal = "";
                    $num = 0;
                    foreach (explode(', ', $user->year_visitors) as $visitorStr) {
                        $visitor = explode(':', $visitorStr);
                        if(date("m-Y", strtotime($visitor[0])) == date('m-Y', strtotime($visit->date))){
                            $visitor[1] = $visitor[1] + $visit->visitors;
                            $visitorStr = implode(':', $visitor);
                            $insert = true;
                        }
                        $delimiter = $num != 0 ? ", " : "";
                        $visitorFinal .= $delimiter. $visitorStr;
                        $num++;
                    }
                    $user->year_visitors = $visitorFinal;
                    $user->save();
                    if(!$insert) {
                        $delimiter = $user->year_visitors != "" ? ", " : "";
                        $user->year_visitors = $user->year_visitors . $delimiter . date('d-m-Y', strtotime($visit->date)) . ":" . $visit->visitors;
                        $user->save();
                    }
                }elseif($visit->local_id){
                    $user = Local::find($visit->local_id);
                    $insert = false;
                    $visitorFinal = "";
                    $num = 0;
                    foreach (explode(', ', $user->year_visitors) as $visitorStr) {
                        $visitor = explode(':', $visitorStr);
                        if(date("m-Y", strtotime($visitor[0])) == date('m-Y', strtotime($visit->date))){
                            $visitor[1] = $visitor[1] + $visit->visitors;
                            $visitorStr = implode(':', $visitor);
                            $insert = true;
                        }
                        $delimiter = $num != 0 ? ", " : "";
                        $visitorFinal .= $delimiter. $visitorStr;
                        $num++;
                    }
                    $user->year_visitors = $visitorFinal;
                    $user->save();
                    if(!$insert) {
                        $delimiter = $user->year_visitors != "" ? ", " : "";
                        $user->year_visitors = $user->year_visitors . $delimiter . date('d-m-Y', strtotime($visit->date)) . ":" . $visit->visitors;
                        $user->save();
                    }
                }
				$visit->delete();
				$date = VisitorDate::find($visit->date_id);
                if($date) {
                    $date->delete();
                }
            }
        }
    }
}
