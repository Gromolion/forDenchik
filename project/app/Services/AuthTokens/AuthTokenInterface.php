<?php

namespace App\Services\AuthTokens;

interface AuthTokenInterface
{
    function encodeToken(int $id, string $name, string $email): string;

    function decodeToken(string $encodedToken): object;

    function isValidToken(string $encodedToken): bool;
}