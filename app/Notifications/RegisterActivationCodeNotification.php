<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Emails\RegisterActivationCodeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RegisterActivationCodeNotification extends Notification implements ShouldQueue
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

    public function toMail($notifiable): RegisterActivationCodeEmail
    {
        return (new RegisterActivationCodeEmail($this->otp_code))
            ->subject('Nerxon Confirmation Code')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->to($this->username);
    }

    public function toSms($notifiable): array
    {
        return [
            'otp_code' => $this->otp_code,
            'phone_number' => $this->username,
            'type' => 'verification_code'
        ];
    }
}
