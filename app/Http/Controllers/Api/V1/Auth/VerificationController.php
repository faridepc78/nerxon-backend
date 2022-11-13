<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\VerificationRequest;
use App\Notifications\WelcomeNotification;
use App\Repositories\UserRepository;
use App\Services\VerifyCodeService;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check(VerificationRequest $request): JsonResponse
    {
        $username = $request->input('username');
        $otp_code = $request->input('otp_code');

        $type = is_numeric($username) ? 'phone_number' : 'email';

        $user = $this->userRepository->findByUsername($username, $type);

        if (!$user) {
            if (!VerifyCodeService::check($username, $otp_code)) {
                return $this->error_response('the otp_code is invalid', 400);
            } else {
                $request->validate([
                    'password' => ['required', 'min:8', 'confirmed']
                ]);

                $user = $this->userRepository->create($username, $request->input('password'));

                VerifyCodeService::delete($username);

                $user->notify(new WelcomeNotification($type));

                return $this->success_response(null, 'user registration was successful', 201);
            }
        } else {
            return $this->error_response('the user has already been verified', 400);
        }
    }
}
