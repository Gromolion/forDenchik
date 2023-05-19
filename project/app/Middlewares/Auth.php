<?php

namespace App\Middlewares;

use App\Config;
use App\HttpStatus\HttpStatus;
use App\Services\AuthTokens\AuthJWT;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class Auth
{
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $encodedToken = explode(' ', $request->getHeader("Authorization")[0])[1];

        $tokenizer = new AuthJWT;

        try {
            $tokenizer->isValidToken($encodedToken);
        } catch (Exception $e) {
            $response = new Response();
            $error = HttpStatus::getError(401);
            $response->getBody()->write($error->getMessage());
            return $response->withStatus($error->getCode());
        }

        return $response;
    }
}
