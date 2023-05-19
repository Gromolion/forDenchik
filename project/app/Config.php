<?php

namespace App;

class Config
{
    private static string $secretKey;
    private static string $serverName;
    private static string $adminRoleCode;
    private static int $JWTExpirationTime;
    private static string $JWTalgo;

    private function __construct()
    {
    }

    public static function init(array $appConfig): void
    {
        self::$secretKey = $appConfig['secretKey'];
        self::$serverName = $appConfig['serverName'];
        self::$adminRoleCode = $appConfig['adminRoleCode'];
        self::$JWTExpirationTime = $appConfig['JWTExpirationTime'];
        self::$JWTalgo = $appConfig['JWTAlgo'];
    }

    public static function getSecretKey(): string
    {
        return self::$secretKey;
    }

    public static function getServerName(): string
    {
        return self::$serverName;
    }

    public static function  getAdminRoleCode(): string
    {
        return self::$adminRoleCode;
    }

    public static function getJWTExpirationTime(): int
    {
        return self::$JWTExpirationTime;
    }

    public static function getJWTAlgo(): string
    {
        return self::$JWTalgo;
    }
}
