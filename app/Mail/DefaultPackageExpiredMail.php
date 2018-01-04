<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DefaultPackageExpiredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $aboutToExpire;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $aboutToExpire = null)
    {
        $this->user = $user;
        $this->aboutToExpire = $aboutToExpire;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@ullalla.com', 'Ullall?')
        ->view('emails.default_package_expired_email');
    }
}