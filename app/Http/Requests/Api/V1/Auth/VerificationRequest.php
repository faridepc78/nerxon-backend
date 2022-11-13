<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Services\VerifyCodeService;
use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required'],
            'otp_code' => VerifyCodeService::getRule()
        ];
    }
}
