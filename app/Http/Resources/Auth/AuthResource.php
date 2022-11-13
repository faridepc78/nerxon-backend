<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'expire_date' => $this->expire_date,
            'storage' => $this->storage,
            'user_mode' => $this->user_mode,
            'last_active_datetime' => $this->last_active_datetime,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'api_token' => $this->createToken($this->username . '_api_token')->plainTextToken
        ];
    }
}
