<?php

namespace App\Services;

class ResponseResult
{
    private array $data;
    private int $statusCode;

    public function __construct(array $result)
    {
        if (isset($result['statusCode'])){
            $this->statusCode = $result['statusCode'];
            unset($result['statusCode']);
        }
        $this->data = $result;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getJsonData(): string
    {
        return json_encode($this->data);
    }

    public function hasStatusCode(): bool
    {
        return isset($this->statusCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
