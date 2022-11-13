<?php

namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function build(): WelcomeEmail
    {
        return $this->view('mails.Welcome')
            ->with([
                'username' => $this->username
            ]);
    }
}
