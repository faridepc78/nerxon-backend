<?php

namespace App\Channels;

use App\Services\SendSms;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $type = $notification->toSms($notifiable)['type'];

        switch ($type) {
            case 'verification_code':
                $phone_number = $notification->toSms($notifiable)['phone_number'];
                $otp_code = $notification->toSms($notifiable)['otp_code'];
                SendSms::verification_code($phone_number, $otp_code);
                break;
            case 'welcome':
                $phone_number = $notification->toSms($notifiable)['phone_number'];
                SendSms::welcome($phone_number);
                break;
            case 'recovery_code':
                $phone_number = $notification->toSms($notifiable)['phone_number'];
                $otp_code = $notification->toSms($notifiable)['otp_code'];
                SendSms::recovery_code($phone_number, $otp_code);
                break;
            case 'update_information':
                $phone_number = $notification->toSms($notifiable)['phone_number'];
                SendSms::update_information($phone_number);
                break;
            default:
                return false;
        }
    }
}
