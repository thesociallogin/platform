<?php

namespace App\Http\Controllers\Login;

use App\Exceptions\ConnectionServerException;
use Closure;
use Illuminate\Http\Response;
use League\OAuth2\Server\Exception\OAuthServerException;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ResponseInterface;

trait HandlesOAuthErrors
{
    /**
     * @throws ConnectionServerException
     */
    protected function withErrorHandling(Closure $closure)
    {
        try {
            return value($closure);
        } catch (OAuthServerException $exception) {
            throw new ConnectionServerException(
                exception: $exception,
                response: $this->convertResponse($exception->generateHttpResponse(new Psr7Response))
            );
        }
    }

    protected function convertResponse(ResponseInterface $response): Response
    {
        return new Response(
            content: $response->getBody(),
            status: $response->getStatusCode(),
            headers: $response->getHeaders()
        );
    }
}
