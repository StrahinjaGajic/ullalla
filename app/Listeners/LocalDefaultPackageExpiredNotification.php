<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\LocalDefaultPackageExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LocalDefaultPackageExpiredNotification
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
     * @param  LocalDefaultPackageExpired  $event
     * @return void
     */
    public function handle(LocalDefaultPackageExpired $event)
    {
        $var = 'title_'. config()->get('app.locale');
        $defaultPackageNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\Local'],
            ['notifiable_id', '=', $event->user->id],
            [$var, '=', 'Local Basic Package Expiration'],
        ])->first();

        if (!$defaultPackageNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package1_expiry_date));
            $notification = new Notification();
            $notification->title_de = 'Ablauf von Lokal Basis-Paket';
            $notification->title_en = 'Local Basic Package Expiration';
            $notification->title_fr = 'Local Basic Package Expiration';
            $notification->title_it = 'Local Basic Package Expiration';
            $notification->note_de = 'Ihr Basis-Paket läuft am ' . $convertedExpiryDate. ' ab';
            $notification->note_en = 'Your basic package expires on ' . $convertedExpiryDate;
            $notification->note_fr = 'Your basic package expires on ' . $convertedExpiryDate;
            $notification->note_it = 'Your basic package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\Local';
            $notification->save();
        }
    }
}
