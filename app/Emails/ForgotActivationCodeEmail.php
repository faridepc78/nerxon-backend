<?php

namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotActivationCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $otp_code;

    public function __construct($otp_code)
    {
        $this->otp_code = $otp_code;
    }

    public function build(): ForgotActivationCodeEmail
    {
        return $this->view('mails.ForgotActivationCode')
            ->with([
                'otp_code' => $this->otp_code
            ]);
    }
}
