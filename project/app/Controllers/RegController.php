<?php

namespace App\Controllers;

use App\Config;
use App\DTO\RegData;
use App\HttpStatus\HttpStatus;
use App\Services\UserRegister;
use App\Services\Utils;

class RegController
{
    public function register(string $name, string $email, string $password): array
    {
        $name = Utils::cleanData($name);
        $email = Utils::cleanData($email);
        $password = Utils::cleanData($password);
        $role = Config::getAdminRoleCode();

        $regData = new RegData($email, $password, $name, $role);

        $user = UserRegister::register($regData);

        if (is_null($user)) {
            return [
                'success' => false,
                'statusCode' => HttpStatus::getError(400)->getCode()
            ];
        }

        return [
            'success' => true,
        ];
    }
}