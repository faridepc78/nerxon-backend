<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $username = fake()->unique()->safeEmail();

        return [
            'username' => $username,
            'email' => $username,
            'expire_date' => now()->addYears(10),
            'user_mode' => User::ACTIVE,
            'password' => '12345678'
        ];
    }
}
