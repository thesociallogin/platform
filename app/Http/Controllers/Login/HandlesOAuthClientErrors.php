<?php

namespace App\Http\Controllers\Login;

use App\Exceptions\IdentityProviderException;
use Closure;
use Illuminate\Http\Response;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException as BaseIdentityProviderException;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ResponseInterface;

trait HandlesOAuthClientErrors
{
    /**
     * @throws IdentityProviderException
     */
    protected function withErrorHandling(Closure $closure)
    {
        try {
            return value($closure);
        } catch (BaseIdentityProviderException $exception) {
            throw new IdentityProviderException(
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
