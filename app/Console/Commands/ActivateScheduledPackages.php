<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class ActivateScheduledPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ullalla:activate-scheduled-packages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command activated packages that have were stored in scheduled_default_packages and scheduled_gotm_packages';

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
        $usersThatHavePendingDefaultPackages = User::whereNotNull('scheduled_default_package')->get();
        $usersThatHavePendingGotmPackages = User::whereNotNull('scheduled_gotm_package')->get();

        $localsThatHavePendingDefaultPackages = Local::whereNotNull('scheduled_default_package')->get();
        $localsThatHavePendingGotmPackages = Local::whereNotNull('scheduled_gotm_package')->get();

        foreach ($usersThatHavePendingDefaultPackages as $user) {
            $scheduledData = explode('&|', $user->scheduled_default_package);
            $packageID = $scheduledData[0];
            $activationDate = $scheduledData[1];
            $expiryDate = $scheduledData[2];

            if (Carbon::parse($user->package1_expiry_date)->isToday()) {
                $user->package1_id = $packageID;
                $user->is_active_d_package = 1;
                $user->package1_activation_date = $activationDate;
                $user->package1_expiry_date = $expiryDate;
                $user->scheduled_default_package = NULL;
                $user->save();
            }
        }

        foreach ($usersThatHavePendingGotmPackages as $user) {
            $scheduledData = explode('&|', $user->scheduled_gotm_package);
            $packageID = $scheduledData[0];
            $activationDate = $scheduledData[1];
            $expiryDate = $scheduledData[2];

            if (Carbon::parse($user->package2_expiry_date)->isToday()) {
                $user->package2_id = $packageID;
                $user->is_active_gotm_package = 1;
                $user->package2_activation_date = $activationDate;
                $user->package2_expiry_date = $expiryDate;
                $user->scheduled_gotm_package = NULL;
                $user->save();
            }
        }

        foreach ($localsThatHavePendingDefaultPackages as $user) {
            $scheduledData = explode('&|', $user->scheduled_default_package);
            $packageID = $scheduledData[0];
            $duration = $scheduledData[1];
            $activationDate = $scheduledData[2];
            $expiryDate = $scheduledData[3];

            if (Carbon::parse($user->package1_expiry_date)->isToday()) {
                $user->package1_id = $packageID;
                $user->is_active_d_package = 1;
                $user->package1_duration = $duration;
                $user->package1_activation_date = $activationDate;
                $user->package1_expiry_date = $expiryDate;
                $user->scheduled_default_package = NULL;
                $user->save();
            }
        }

        foreach ($localsThatHavePendingGotmPackages as $user) {
            $scheduledData = explode('&|', $user->scheduled_gotm_package);
            $packageID = $scheduledData[0];
            $activationDate = $scheduledData[1];
            $expiryDate = $scheduledData[2];

            if (Carbon::parse($user->package2_expiry_date)->isToday()) {
                $user->package2_id = $packageID;
                $user->is_active_gotm_package = 1;
                $user->package2_activation_date = $activationDate;
                $user->package2_expiry_date = $expiryDate;
                $user->scheduled_gotm_package = NULL;
                $user->save();
            }
        }
    }
}
