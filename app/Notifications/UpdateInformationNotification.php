<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Emails\UpdateInformationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UpdateInformationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $type;
    private $username;

    public function __construct($type, $username)
    {
        $this->type = $type;
        $this->username = $username;
    }

    public function via($notifiable): array
    {
        return $this->type == 'email' ? ['mail'] : [SmsChannel::class];
    }

    public function toMail($notifiable): UpdateInformationEmail
    {
        return (new UpdateInformationEmail($this->username))
            ->subject('Nerxon Update Information')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->to($this->username);
    }

    public function toSms($notifiable): array
    {
        return [
            'phone_number' => $this->username,
            'type' => 'update_information'
        ];
    }
}
