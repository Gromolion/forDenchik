<?php

namespace App\Services;

class RouteBuilder
{
    private string $route;
    private array $methods;
    private string $action;
    private array $middlewaresNames;

    public function __construct(string $route, array $methods, string $action) {
        $this->route = $route;
        $this->methods = $methods;
        $this->action = $action;
        $this->middlewaresNames = [];
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setMiddlewares($middlewaresNames): void
    {
        $this->middlewaresNames = $middlewaresNames;
    }

    public function getMiddlewares(): ?array
    {
        return $this->middlewaresNames;
    }
}
