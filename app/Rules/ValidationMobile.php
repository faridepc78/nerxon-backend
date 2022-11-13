<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationMobile implements Rule
{
    public function passes($attribute, $value): bool|int
    {
        $pattern = '/^((\+98)9\d{9})$/m';

        return preg_match($pattern, $value);
    }

    public function message(): string
    {
        return 'the phone_number is invalid.';
    }
}
