<?php

namespace App\Services\AuthTokens;

use App\Config;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthJWT implements AuthTokenInterface
{
    private $secretKey;
    private $serverName;
    private $algo;
    private $expirationTime;

    public function __construct()
    {
        $this->secretKey = Config::getSecretKey();
        $this->expirationTime = Config::getJWTExpirationTime();
        $this->serverName = Config::getServerName();
        $this->algo = Config::getJWTAlgo();
    }

    public function encodeToken(int $id, string $name, string $email): string
    {
        $issuedAt = time();

        $token = [
            'iat' => $issuedAt,
            'iss' => $this->serverName,
            'nbf' => $issuedAt,
            'exp' => $issuedAt + $this->expirationTime,
            'data' => [
                'id' => $id,
                'name' => $name,
                'email' => $email,
            ]
        ];

        return JWT::encode($token, $this->secretKey, $this->algo);
    }

    public function decodeToken(string $encodedToken): object
    {
        return JWT::decode($encodedToken, new Key($this->secretKey, $this->algo));
    }

    public function isValidToken(string $encodedToken): bool
    {
        $decodedToken = $this->decodeToken($encodedToken);
        $now = time();

        return $decodedToken->iss === $this->serverName || $decodedToken->nbf <= $now || $decodedToken->exp > $now;
    }
}