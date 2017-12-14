<?php

namespace App\Console\Commands;

use DB;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\DefaultPackageExpiredMail;
use App\Mail\GirlOfTheMonthPackageExpiredMail;

class DeactivateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ullalla:deactivate-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate user temporarily if his package is expired';

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
        $defaultPackageUsers = User::where('is_active_d_package', '1')->whereDate('package1_expiry_date', '<=', Carbon::now())->get();
        $gotmPackageUsers = User::where('is_active_gotm_package', '1')->whereDate('package2_expiry_date', '<=', Carbon::now())->get();

        foreach ($defaultPackageUsers as $user) {
            $package1ExpiryDate = Carbon::parse($user->package1_expiry_date)->format('Y-m-d');
            $user->is_active_d_package = 0;
            $user->save();
            Mail::to($user->email)->send(new DefaultPackageExpiredMail($user));
        }

        foreach ($gotmPackageUsers as $user) {
            $package2ExpiryDate = Carbon::parse($user->package2_expiry_date)->format('Y-m-d');
            $user->is_active_gotm_package = 0;
            $user->save();
            Mail::to($user->email)->send(new GirlOfTheMonthPackageExpiredMail($user));
        }
    }
}
