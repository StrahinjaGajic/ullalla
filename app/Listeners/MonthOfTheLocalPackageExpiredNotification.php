<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\MonthOfTheLocalPackageExpired;

class MonthOfTheLocalPackageExpiredNotification
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
    public function handle(MonthOfTheLocalPackageExpired $event)
    {
        $var = 'title_'. config()->get('app.locale');
        $girlOfTheMonthNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\Local'],
            ['notifiable_id', '=', $event->user->id],
            [$var, '=', 'Local of The Month Package Expiration'],
        ])->first();

        if (!$girlOfTheMonthNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package2_expiry_date));
            $notification = new Notification();
            $notification->title_de = 'Ablauf von Lokal des Monats-Paket';
            $notification->title_en = 'Local of The Month Package Expiration';
            $notification->title_fr = 'Local of The Month Package Expiration';
            $notification->title_it = 'Local of The Month Package Expiration';
            $notification->note_de = 'Ihr Lokal des Monats-Paket läuft am ' . $convertedExpiryDate. ' ab';
            $notification->note_en = 'Your local of the month package expires on ' . $convertedExpiryDate;
            $notification->note_fr = 'Your local of the month package expires on ' . $convertedExpiryDate;
            $notification->note_it = 'Your local of the month package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\Local';
            $notification->save();
        }
    }
}
