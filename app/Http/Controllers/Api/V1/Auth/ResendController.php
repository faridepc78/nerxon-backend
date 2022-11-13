<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Channels\SmsChannel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ResendRequest;
use App\Notifications\ForgotActivationCodeNotification;
use App\Notifications\RegisterActivationCodeNotification;
use App\Services\VerifyCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ResendController extends Controller
{
    public function __invoke(ResendRequest $request): JsonResponse
    {
        $username = $request->input('username');
        $notify_type = $request->input('notify_type');
        $otp_code = VerifyCodeService::generate();

        if (VerifyCodeService::has($username)) {
            if (now()->timestamp > VerifyCodeService::get($username)[1]) {
                $this->send_notification($username, $otp_code, $notify_type);
            } else {
                return $this->error_response('the code has already been sent to you. please try again in 2 minutes', 400);
            }
        } else {
            $this->send_notification($username, $otp_code, $notify_type);
        }

        return $this->success_response(null, 'the activation code has been sent again');
    }

    protected function send_notification($username, $otp_code, $notify_type)
    {
        if (!is_numeric($username)) {
            $type = 'email';

            VerifyCodeService::store($username, $otp_code,
                strtotime(now()->addMinutes(2)), now()->addMinutes(5));

            if ($notify_type == 'register') {
                Notification::route('mail', $username)
                    ->notify(new RegisterActivationCodeNotification($type, $otp_code, $username));
            } else {
                Notification::route('mail', $username)
                    ->notify(new ForgotActivationCodeNotification($type, $otp_code, $username));
            }

        } else {
            $type = 'phone_number';

            VerifyCodeService::store($username, $otp_code,
                strtotime(now()->addMinutes(2)), now()->addMinutes(2));

            if ($notify_type == 'register') {
                Notification::route(SmsChannel::class, $username)
                    ->notify(new RegisterActivationCodeNotification($type, $otp_code, $username));
            } else {
                Notification::route(SmsChannel::class, $username)
                    ->notify(new ForgotActivationCodeNotification($type, $otp_code, $username));
            }

        }
    }
}
