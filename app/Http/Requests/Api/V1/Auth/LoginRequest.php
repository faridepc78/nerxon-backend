<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Rules\ValidationMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type' => ['required', Rule::in(['email', 'phone_number'])]
        ];

        if (request()->input('type') == 'email') {
            $rules['username'] = ['required', 'max:255', 'email'];
        } else {
            $rules['username'] = ['required', new ValidationMobile()];
        }

        return $rules;
    }
}
