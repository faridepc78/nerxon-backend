<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UpdateProfileRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function info(): JsonResponse
    {
        return $this->success_response(new UserResource(Auth::user()),
            'user information');
    }

    public function update_info(UpdateProfileRequest $request): JsonResponse
    {
        $this->userRepository->updateProfile(array_filter($request->all()),
            Auth::id());

        return $this->success_response(new UserResource(Auth::user()->refresh()),
            'user information has been successfully updated');
    }
}
