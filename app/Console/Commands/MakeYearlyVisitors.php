<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorDateUser;
use App\Models\VisitorDate;

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
        $visits = VisitorDateUser::join('visitor_dates', 'visitor_dates.id', '=', 'visitor_date_user.visitor_date_id')->select('visitor_dates.id AS date_id', 'visitor_dates.date', 'visitor_date_user.*')->get();

        foreach($visits as $visit){
            if(date('m-Y', strtotime($visit->date)) == date('m-Y')){
                if($visit->user_id){
                    $user = User::find($visit->user_id);
                    $user->year_visitors = $user->year_visitors. date('d-m-Y', strtotime($visit->date)). ":". $visit->visitors. ", ";
                    $user->save();
                }elseif($visit->local_id){
                    $user = Local::find($visit->local_id);
                    $user->year_visitors = $user->year_visitors. date('d-m-Y', strtotime($visit->date)). ":". $visit->visitors. ", ";
                    $user->save();
                }
//				$visit->delete();
//				$date = VisitorDate::find($visit->date_id);
//				$date->delete();
            }
        }
    }
}
