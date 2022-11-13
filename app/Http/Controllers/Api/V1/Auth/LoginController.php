<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Channels\SmsChannel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Notifications\RegisterActivationCodeNotification;
use App\Repositories\UserRepository;
use App\Services\VerifyCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function process(LoginRequest $request): JsonResponse
    {
        $user = $this->userRepository
            ->findByUsername($request->input('username'),
                $request->input('type'));

        return $user == null ? $this->register($request) : $this->login($request);
    }

    protected function register(Request $request): JsonResponse
    {
        $username = $request->input('username');
        $type = $request->input('type');
        $otp_code = VerifyCodeService::generate();

        if ($type == 'email') {
            VerifyCodeService::store($username, $otp_code,
                strtotime(now()->addMinutes(2)), now()->addMinutes(5));

            Notification::route('mail', $username)
                ->notify(new RegisterActivationCodeNotification($type, $otp_code, $username));
        } else {
            VerifyCodeService::store($username, $otp_code,
                strtotime(now()->addMinutes(2)), now()->addMinutes(2));

            Notification::route(SmsChannel::class, $username)
                ->notify(new RegisterActivationCodeNotification($type, $otp_code, $username));
        }

        return $this->success_response(null,
            'activation code was sent');
    }

    protected function login(Request $request): JsonResponse
    {
        $username = $request->input('username');
        $type = $request->input('type');

        $request->validate([
            'password' => ['required']
        ]);

        if (Auth::attempt([$type => $username,
            'password' => $request->input('password')])) {

            $this->userRepository->updateLastActive(Auth::id());

            return $this->success_response([new AuthResource(Auth::user())],
                'login was successful');
        } else {
            return $this->error_response('no information was found with this username', 401);
        }
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return $this->success_response(null, 'logout was successful');
    }
}
