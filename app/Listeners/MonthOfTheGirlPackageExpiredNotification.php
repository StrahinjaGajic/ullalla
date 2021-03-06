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
        $var = 'title_'. config()->get('app.locale');
        $girlOfTheMonthNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\User'],
            ['notifiable_id', '=', $event->user->id],
            [$var, '=', 'Girl of The Month Package Expiration'],
        ])->first();

        if (!$girlOfTheMonthNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package2_expiry_date));
            $notification = new Notification();
            $notification->title_de = 'Ablauf Girl des Monats-Paket';
            $notification->title_en = 'Girl of The Month Package Expiration';
            $notification->title_it = 'Scadenza del pacchetto ragazza del mese';
            $notification->title_fr = 'Girl of The Month Package Expiration';
            $notification->note_de = 'Ihr Girl des Monats l�uft am ' . $convertedExpiryDate. ' ab';
            $notification->note_en = 'Your girl of the month package expires on ' . $convertedExpiryDate;
            $notification->note_it = 'Il suo pachetto ragazza del mese scade il ' . $convertedExpiryDate;
            $notification->note_fr = 'Your girl of the month package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\User';
            $notification->save();
        }
    }
}
