<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function create($username, $password): Model|Builder
    {
        if (is_numeric($username)) {
            $email = null;
            $phone_number = $username;
        } else {
            $email = $username;
            $phone_number = null;
        }

        return User::query()
            ->create([
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'expire_date' => now()->addYears(10),
                'user_mode' => User::ACTIVE,
                'password' => $password
            ]);
    }

    public function findByUsername($username, $type): Model|Builder|null
    {
        return User::query()
            ->where($type, '=', $username)
            ->first();
    }

    public function updatePassword($username, $password): int
    {
        return User::query()
            ->where('username', '=', $username)
            ->update([
                'password' => bcrypt($password)
            ]);
    }

    public function updateLastActive($id): bool|int
    {
        return User::query()
            ->findOrFail($id)
            ->update([
                'last_active_datetime' => now()
            ]);
    }

    public function updateProfile($data, $id): int
    {
        return User::query()
            ->where('id', '=', $id)
            ->update([
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'country' => $data['country'],
                'city' => $data['city'],
                'address' => $data['address'],
                'password' => bcrypt($data['password'])
            ]);
    }
}
