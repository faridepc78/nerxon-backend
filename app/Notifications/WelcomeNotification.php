<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Emails\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function via($notifiable): array
    {
        return $this->type == 'email' ? ['mail'] : [SmsChannel::class];
    }

    public function toMail($notifiable): WelcomeEmail
    {
        return (new WelcomeEmail($notifiable->username))
            ->subject('Welcome to Nerxon')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->to($notifiable->username);
    }

    public function toSms($notifiable): array
    {
        return [
            'phone_number' => $notifiable->username,
            'type' => 'welcome'
        ];
    }
}
