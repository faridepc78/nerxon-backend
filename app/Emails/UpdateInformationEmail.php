<?php

namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateInformationEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function build(): UpdateInformationEmail
    {
        return $this->view('mails.UpdateInformation')
            ->with([
                'username' => $this->username
            ]);
    }
}
