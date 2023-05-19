<?php

namespace App\DTO;

class RequestDTO
{
    private array $get;
    private array $post;
    private string $uri;
    private string $method;

    public function __construct(array $get, array $post, string $uri, string $method)
    {
        $this->get = $get;
        $this->post = $post;
        $this->uri = $uri;
        $this->method = $method;
    }

    public function getURI(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameter(string $requestMethod, string $parameter): ?string
    {
        return $this->{strtolower($requestMethod)}[$parameter] ?? null;
    }
}