<?php

namespace App\Router;

use App\Exceptions\ServerException;
use App\Services\RouteBuilder;
use App\Services\RouteMethod;
use Closure;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use ReflectionClass;
use ReflectionException;
use Slim\App;
use Slim\Factory\AppFactory;

class Router
{
    private App $app;
    private const MIDDLEWARES_NAMESPACE = "App\Middlewares\\";
    private const METHOD_GET = "GET";

    /**
     * @throws ServerException
     */
    public function __construct(array $routes)
    {
        $this->app = AppFactory::create();
        $this->initRoutes($routes);
    }

    /**
     * @throws ServerException
     */
    private function initRoutes(array $routes): void
    {
        foreach ($routes as $route => $params) {
            $routeBuilder = new RouteBuilder($route, $params["method"], $params["action"]);
            if (isset($params["middlewares"])) {
                $routeBuilder->setMiddlewares($params["middlewares"]);
            }
            $this->buildRoute($routeBuilder);
        }
    }

    /**
     * @throws ServerException
     */
    private function addMiddlewares(array $middlewaresNames, $slimRoute): void
    {
        try {
            foreach ($middlewaresNames as $middlewareName) {
                $middleware = (new ReflectionClass(self::MIDDLEWARES_NAMESPACE . $middlewareName))->newInstance();
                $slimRoute->add($middleware);
            }
        } catch (ReflectionException $e) {
            throw new ServerException();
        }
    }

    /**
     * @throws ServerException
     */
    public function buildRoute(RouteBuilder $routeBuilder): void
    {
        foreach ($routeBuilder->getMethods() as $method) {
            $uri = $routeBuilder->getRoute();
            $action = $routeBuilder->getAction();
            $slimRoute = $this->addRoute($uri, $method, $action);

            $middlewares = $routeBuilder->getMiddlewares();
            if (isset($middlewares)) {
                $this->addMiddlewares($middlewares, $slimRoute);
            }
        }
    }

    private function addRoute($uri, $method, $action)
    {
        [$controllerName, $controllerMethodName] = explode("@", $action);
        return $this->app->$method($uri, $this->getRouteHandler($controllerMethodName, $controllerName));
    }

    public function getRouteHandler(string $controllerMethodName, string $controllerName): Closure
    {
        return function (Request $request, Response $response, $args) use ($controllerMethodName, $controllerName) {
            if ($request->getMethod() === self::METHOD_GET) {
                $requestParams = $request->getQueryParams();
            } else {
                $requestParams = $request->getParsedBody();
            }
            $result = RouteMethod::call($controllerName, $controllerMethodName, $requestParams);
            if ($result->hasStatusCode()) {
                $response = $response->withStatus($result->getStatusCode());
            }
            $response->getBody()->write($result->getJsonData());
            return $response;
        };
    }

    public function execute(): void
    {
        $this->app->run();
    }
}
