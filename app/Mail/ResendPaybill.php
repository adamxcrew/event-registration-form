<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResendPaybill extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('mails.resend_paybill')->with([
            'name' => $this->user->name,
            'username' => $this->user->username,
            'password' => $this->password,
            'registration' => $this->user->registration,
        ]);
    }
}
