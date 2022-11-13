<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $guarded =
        [
            'id',
            'created_at',
            'updated_at'
        ];

    protected $fillable =
        [
            'username',
            'email',
            'phone_number',
            'country',
            'city',
            'address',
            'expire_date',
            'storage',
            'user_mode',
            'password',
            'last_active_datetime'
        ];

    const ACTIVE = 'active';
    const BLOCKED = 'blocked';
    const SUSPENDED_BLOCKED = 'suspended_blocked';
    static array $user_modes =
        [
            self::ACTIVE,
            self::BLOCKED,
            self::SUSPENDED_BLOCKED
        ];

    protected $hidden =
        [
            'password'
        ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
