<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\PackageExpired;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PackageExpiredNotification
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
    public function handle(PackageExpired $event)
    {
        $var = 'title_'. config()->get('app.locale');
        $defaultPackageNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\User'],
            ['notifiable_id', '=', $event->user->id],
            [$var, '=', 'Basic Package Expiration'],
        ])->first();
        
        if (!$defaultPackageNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package1_expiry_date));
            $notification = new Notification();
            $notification->title_de = 'Basic Package Expiration';
            $notification->title_en = 'Basic Package Expiration';
            $notification->title_fr = 'Basic Package Expiration';
            $notification->title_it = 'Basic Package Expiration';
            $notification->note_de = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->note_en = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->note_fr = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->note_it = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\User';
            $notification->save();
        }
    }
}
