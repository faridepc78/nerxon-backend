<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Channels\SmsChannel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\VerificationRequest;
use App\Notifications\ForgotActivationCodeNotification;
use App\Notifications\UpdateInformationNotification;
use App\Repositories\UserRepository;
use App\Services\VerifyCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ForgotController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function forgot(LoginRequest $request): JsonResponse
    {
        $username = $request->input('username');
        $type = $request->input('type');

        $user = $this->userRepository->findByUsername($username, $type);

        if ($user) {

            $otp_code = VerifyCodeService::generate();

            if ($type == 'email') {
                VerifyCodeService::store($username, $otp_code,
                    strtotime(now()->addMinutes(2)), now()->addMinutes(5));
            } else {
                VerifyCodeService::store($username, $otp_code,
                    strtotime(now()->addMinutes(2)), now()->addMinutes(2));
            }

            $user->notify(new ForgotActivationCodeNotification($type, $otp_code, $username));

            return $this->success_response(null,
                'activation code was sent');

        } else {
            return $this->error_response('no information was found with this username', 401);
        }
    }

    public function update_password(VerificationRequest $request): JsonResponse
    {
        $username = $request->input('username');
        $otp_code = $request->input('otp_code');

        if (!VerifyCodeService::check($username, $otp_code)) {
            return $this->error_response('the otp_code is invalid', 400);
        } else {
            $request->validate([
                'password' => ['required', 'min:8', 'confirmed']
            ]);

            $type = is_numeric($username) ? 'phone_number' : 'email';

            $this->userRepository->updatePassword($username, $request->input('password'));

            VerifyCodeService::delete($username);

            if ($type == 'email') {
                Notification::route('mail', $username)
                    ->notify(new UpdateInformationNotification($type, $username));
            } else {
                Notification::route(SmsChannel::class, $username)
                ->notify(new UpdateInformationNotification($type, $username));
            }

            return $this->success_response(null, 'password successfully updated');
        }
    }
}
