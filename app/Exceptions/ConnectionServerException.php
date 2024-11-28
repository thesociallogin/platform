<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\OAuth2\Server\Exception\OAuthServerException as LeagueException;

class ConnectionServerException extends Exception
{
    public function __construct(
        protected LeagueException $exception,
        protected Response $response
    ) {
        parent::__construct($this->exception->getMessage(), $this->exception->getCode(), $this->exception->getPrevious());
    }

    public function render(Request $request): Response
    {
        return $this->response;
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }
}
