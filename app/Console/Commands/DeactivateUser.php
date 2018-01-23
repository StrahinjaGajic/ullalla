<?php

namespace App\Console\Commands;

use DB;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Local;
use Illuminate\Console\Command;
use App\Mail\DefaultPackageExpiredMail;
use App\Mail\GirlOfTheMonthPackageExpiredMail;
use App\Mail\LocalDefaultPackageExpiredMail;

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
        $defaultPackageLocals = Local::where('is_active_d_package', '1')->whereDate('package1_expiry_date', '<=', Carbon::now())->get();
        $gotmPackageLocals = Local::where('is_active_gotm_package', '1')->whereDate('package2_expiry_date', '<=', Carbon::now())->get();

        foreach ($defaultPackageUsers as $user) {
            $user->is_active_d_package = 0;
            $user->save();
            if ($user->sms_notifications == 1) {
                sendPlivoMessage('+38160319825', $user->mobile, __('messages.email_expired_package') . ' ' . url('@' . $user->username . '/packages'));
            } else {
                Mail::to($user->email)->send(new DefaultPackageExpiredMail($user));
            }
        }

        foreach ($gotmPackageUsers as $user) {
            $user->is_active_gotm_package = 0;
            $user->save();
            if ($user->sms_notifications == 1) {
                sendPlivoMessage('+38160319825', $user->mobile, __('messages.email_gotm_expired_package') . ' ' . url('@' . $user->username . '/packages'));
            } else {
                Mail::to($user->email)->send(new GirlOfTheMonthPackageExpiredMail($user));
            }
        }

        foreach ($defaultPackageLocals as $user) {
            $user->is_active_d_package = 0;
            $user->save();
            Mail::to($user->email)->send(new LocalDefaultPackageExpiredMail($user));
        }

        foreach ($gotmPackageLocals as $user) {
            $user->is_active_gotm_package = 0;
            $user->save();
            if ($user->sms_notifications == 1) {
                sendPlivoMessage('+38160319825', $user->mobile, __('messages.lmail_gotm_expired_package') . ' ' . url('@' . $user->username . '/packages'));
            } else {
                Mail::to($user->email)->send(new GirlOfTheMonthPackageExpiredMail($user));
            }
        }
        
        $defaultPackageAboutToExpireUsers = User::where('is_active_d_package', '1')->whereDate('package1_expiry_date', '>', Carbon::now())->get();
        $gotmPackageAboutToExpireUsers = User::where('is_active_gotm_package', '1')->whereDate('package2_expiry_date', '>', Carbon::now())->get();
        $localDefaultPackageAboutToExpireUsers = Local::where('is_active_d_package', '1')->whereDate('package1_expiry_date', '>', Carbon::now())->get();
        $lotmPackageAboutToExpireUsers = Local::where('is_active_gotm_package', '1')->whereDate('package2_expiry_date', '>', Carbon::now())->get();

        $carbonNowFormated = Carbon::now()->format('Y-m-d');

        // defaultPackageAboutToExpireDatesForSendingMails
        foreach ($defaultPackageAboutToExpireUsers as $user) {
            $package1ExpiryDateCarbonParsed = Carbon::parse($user->package1_expiry_date);
            foreach (getDaysForExpiry($user->package1_id) as $day) {
                if ($carbonNowFormated == $package1ExpiryDateCarbonParsed->subDays($day)->format('Y-m-d')) {
                    // send mail
                    $aboutToExpire = '';
                    if ($user->sms_notifications == 1) {
                        sendPlivoMessage('+38160319825', $user->mobile, __('messages.email_expire_warning_package') . ' ' . url('@' . $user->username . '/packages'));
                    } else {
                        Mail::to($user->email)->send(new DefaultPackageExpiredMail($user, $aboutToExpire));
                    }
                }
            }
        }

        //girlOfTheMonthAboutToExpireDatesForSendingMails
        foreach ($gotmPackageAboutToExpireUsers as $user) {
            $package2ExpiryDateCarbonParsed = Carbon::parse($user->package2_expiry_date);
            foreach (getDaysForExpiry($user->package2_id) as $day) {
                if ($carbonNowFormated == $package2ExpiryDateCarbonParsed->subDays($day)->format('Y-m-d')) {
                    // send mail
                    $aboutToExpire = '';
                    if ($user->sms_notifications == 1) {
                        sendPlivoMessage('+38160319825', $user->mobile, __('messages.email_gotm_expire_warning_package') . ' ' . url('@' . $user->username . '/packages'));
                    } else {
                        Mail::to($user->email)->send(new GirlOfTheMonthPackageExpiredMail($user, $aboutToExpire));
                    }
                }
            }
        }

        // defaultPackageAboutToExpireDatesForSendingMails
        foreach ($localDefaultPackageAboutToExpireUsers as $user) {
            $package1ExpiryDateCarbonParsed = Carbon::parse($user->package1_expiry_date);
            foreach (getDaysForExpiryLocal($user->package1_duration) as $day) {
                if ($carbonNowFormated == $package1ExpiryDateCarbonParsed->subDays($day)->format('Y-m-d')) {
                    // send mail
                    // email_expired_package
                    $aboutToExpire = '';
                    Mail::to($user->email)->send(new LocalDefaultPackageExpiredMail($user, $aboutToExpire));
                }
            }
        }

        //localOfTheMonthAboutToExpireDatesForSendingMails
        foreach ($lotmPackageAboutToExpireUsers as $user) {
            $package2ExpiryDateCarbonParsed = Carbon::parse($user->package2_expiry_date);
            foreach (getDaysForExpiry($user->package2_id) as $day) {
                if ($carbonNowFormated == $package2ExpiryDateCarbonParsed->subDays($day)->format('Y-m-d')) {
                    // send mail
                    $aboutToExpire = '';
                    if ($user->sms_notifications == 1) {
                        sendPlivoMessage('+38160319825', $user->mobile, __('messages.email_gotm_expire_warning_package') . ' ' . url('@' . $user->username . '/packages'));
                    } else {
                        Mail::to($user->email)->send(new GirlOfTheMonthPackageExpiredMail($user, $aboutToExpire));
                    }
                }
            }
        }
    }
}
