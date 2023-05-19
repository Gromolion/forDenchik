<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Exceptions\ServerException;
use ArgumentCountError;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class RouteMethod
{
    private const CONTROLLERS_NAMESPACE = "App\Controllers\\";

    /**
     * @throws ServerException
     * @throws NotFoundException
     */
    public static function call(string $controllerName, string $controllerMethod, array $requestParams): ResponseResult
    {
        try {
            $controller = self::getController($controllerName);
            $reflectionMethod = new ReflectionMethod($controller, $controllerMethod);

            $reflectionParameters = $reflectionMethod->getParameters();
            $methodArgs = self::getMethodArgs($reflectionParameters, $requestParams);

            return new ResponseResult($reflectionMethod->invokeArgs($controller, $methodArgs));
        } catch (ArgumentCountError $e) {
            throw new NotFoundException();
        } catch (ReflectionException $e) {
            throw new ServerException();
        }
    }

    /**
     * @throws ReflectionException
     */
    private static function getController(string $controllerName): object
    {
        $reflectionClass = new ReflectionClass(self::CONTROLLERS_NAMESPACE . $controllerName);
        return $reflectionClass->newInstance();
    }

    private static function getMethodArgs(array $reflectionParameters, array $requestParams): array
    {
        $methodArgs = [];
        foreach ($reflectionParameters as $parameter) {
            $arg = $requestParams[$parameter->getName()];
            $arg && $methodArgs[] = $arg;
        }
        return $methodArgs;
    }
}