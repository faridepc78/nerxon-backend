<?php

namespace App\Http\Requests\Api\V1\User;

use App\Rules\ValidationMobile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'string', 'email', 'unique:users,email,' . auth()->id()],
            'phone_number' => ['nullable', 'numeric', new ValidationMobile(), 'unique:users,phone_number,' . auth()->id()],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:3000'],
            'password' => ['nullable', 'min:8', 'confirmed']
        ];
    }
}
