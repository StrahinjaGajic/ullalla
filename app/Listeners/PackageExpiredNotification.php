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
        $defaultPackageNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\User'],
            ['notifiable_id', '=', $event->user->id],
            ['title', '=', 'Default Package Expiration'],
        ])->first();
        
        if (!$defaultPackageNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package1_expiry_date));
            $notification = new Notification();
            $notification->title = 'Default Package Expiration';
            $notification->note = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\User';
            $notification->save();
        }
    }
}
