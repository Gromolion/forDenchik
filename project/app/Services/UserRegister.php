<?php

namespace App\Services;

use App\DTO\RegData;
use App\Models\Role;
use App\Models\User;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserRegister
{
    public static function register(RegData $regData): ?User
    {
        try {
            $user = User::create([
                'name' => $regData->getName(),
                'email' => $regData->getEmail(),
                'password' => password_hash($regData->getPassword(), PASSWORD_BCRYPT)
            ]);
            $roleAdmin = Role::where('code', $regData->getCodeRole())->first();
            $roleAdmin->users()->save($user);
        } catch (Exception $e) {
            return null;
        }

        return $user;
    }
}