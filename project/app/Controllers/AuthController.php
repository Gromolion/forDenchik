<?php

namespace App\Controllers;

use App\Config;
use App\DTO\AuthData;
use App\HttpStatus\HttpStatus;
use App\Services\AuthTokens\AuthJWT;
use App\Services\UserAuth;
use App\Services\Utils;
use JetBrains\PhpStorm\ArrayShape;

class AuthController
{
    public function auth(string $email, string $password): array
    {
        $email = Utils::cleanData($email);
        $password = Utils::cleanData($password);

        $authData = new AuthData($email, $password);
        $user = UserAuth::authorize($authData);
        if (is_null($user)) {
            return [
                'success' => false,
                'statusCode' => HttpStatus::getError(401)->getCode()
            ];
        }

        $tokenizer = new AuthJWT;

        $jwt = $tokenizer->encodeToken($user->id, $user->name, $user->email);
        return [
            'success' => true,
            'jwt' => $jwt
        ];
    }

    #[ArrayShape(['success' => "bool"])]
    public function logout(): array
    {
        return [
            'success' => true,
        ];
    }
}
