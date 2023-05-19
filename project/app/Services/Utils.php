<?php

namespace App\Services;

class Utils
{
    public static function cleanData($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return htmlspecialchars($data);
    }
}