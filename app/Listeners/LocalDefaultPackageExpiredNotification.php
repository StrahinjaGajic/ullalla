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
        $defaultPackageNotification = Notification::where([
            ['notifiable_type', '=', 'App\Models\Local'],
            ['notifiable_id', '=', $event->user->id],
            ['title', '=', 'Local Default Package Expiration'],
        ])->first();

        if (!$defaultPackageNotification) {
            $convertedExpiryDate = date('jS F Y', strtotime($event->user->package1_expiry_date));
            $notification = new Notification();
            $notification->title = 'Local Default Package Expiration';
            $notification->note = 'Your default package expires on ' . $convertedExpiryDate;
            $notification->notifiable_id = $event->user->id;
            $notification->notifiable_type = 'App\Models\Local';
            $notification->save();
        }
    }
}
