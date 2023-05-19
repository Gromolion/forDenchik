<?php

namespace App\HttpStatus;

class HttpStatus
{
    private static array $httpErrors;

    private function __construct()
    {
    }

    public static function init(array $config): void
    {
        foreach ($config as $code => $message) {
            self::$httpErrors[$code] = new HttpError($code, $message);
        }
    }

    public static function getError(int $code): HttpError
    {
        return self::$httpErrors[$code];
    }
}