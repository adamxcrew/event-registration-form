<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.registered')->with([
                'name' => $this->user->name,
                'username' => $this->user->username,
                'password' => $this->password,
                'package' => $this->user->registration->package->description ?? '-',
                'category' => $this->user->registration->category->name ?? '-',
                'paybill' => $this->user->registration->paybill ?? 0,
            ]);
    }
}
