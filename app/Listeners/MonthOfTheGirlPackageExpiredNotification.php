<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\MonthOfTheGirlPackageExpired;

class MonthOfTheGirlPackageExpiredNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MonthOfTheGirlPackageExpired $event)
    {
        $girlOfTheMonthNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\User'],
            ['notifiable_id', '=', $event->user->id],
            ['title', '=', 'Girl of The Month Package Expiration'],
        ])->first();

        if (!$girlOfTheMonthNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package2_expiry_date));
            $notification = new Notification();
            $notification->title = 'Girl of The Month Package Expiration';
            $notification->note = 'Your girl of the month package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\User';
            $notification->save();
        }
    }
}
