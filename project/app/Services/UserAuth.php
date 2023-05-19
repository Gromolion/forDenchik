<?php

namespace App\Services;

use App\DTO\AuthData;
use App\Models\User;

class UserAuth
{
    public static function authorize(AuthData $authData): ?User
    {
        $user = User::where('email', $authData->getEmail())->first();
        if (!password_verify($authData->getPassword(), $user->password)) {
            return null;
        }
        return $user;
    }
}