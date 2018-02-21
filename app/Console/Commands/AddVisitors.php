<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VisitorDateUser;

class AddVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ullalla:add-visitors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add more visitors and active all visitors for this day';

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
            if(date('d-m-Y', strtotime($visit->date)) == date('d-m-Y')){
                $visit->active = 1;
                $visit->visitors = $visit->visitors + rand(50,150);
                $visit->save();
            }
        }
    }
}
