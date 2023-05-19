<?php

namespace App;

require 'vendor/autoload.php';

use App\Exceptions\NotFoundException;
use App\Exceptions\ServerException;
use App\HttpStatus\HttpStatus;
use App\Router\Router;
use TypeError;

$routes = include "routes.php";
$appConfig = include "config/app_config.php";
$httpStatusConfig = include "config/http_status_config.php";

HttpStatus::init($httpStatusConfig);
Config::init($appConfig);

try {
    $router = new Router($routes);
    $router->execute();
} catch (NotFoundException $e) {
    header("HTTP/1.1 404 Not Found");
    echo "Страница не найдена";
} catch (ServerException $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo "Внутренняя ошибка сервера";
} catch (TypeError $e) {
    header("HTTP/1.1 400 Bad Request");
    echo "Bad Request";
}
