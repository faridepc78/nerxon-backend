<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Emails\ForgotActivationCodeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ForgotActivationCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $type;
    private $otp_code;
    private $username;

    public function __construct($type, $otp_code, $username)
    {
        $this->type = $type;
        $this->otp_code = $otp_code;
        $this->username = $username;
    }

    public function via($notifiable): array
    {
        return $this->type == 'email' ? ['mail'] : [SmsChannel::class];
    }

    public function toMail($notifiable): ForgotActivationCodeEmail
    {
        return (new ForgotActivationCodeEmail($this->otp_code))
            ->subject('Nerxon Password Recovery')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->to($this->username);
    }

    public function toSms($notifiable): array
    {
        return [
            'otp_code' => $this->otp_code,
            'phone_number' => $this->username,
            'type' => 'recovery_code'
        ];
    }
}
