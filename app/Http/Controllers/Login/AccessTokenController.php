<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\ConnectionAuthorizationServerInterface;
use App\Exceptions\ConnectionServerException;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Response;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;

class AccessTokenController extends Controller
{
    use HandlesOAuthServerErrors;

    public function __construct(
        protected ConnectionAuthorizationServerInterface $server,
    ) {
        //
    }

    /**
     * @throws ConnectionServerException
     */
    public function __invoke(ServerRequestInterface $request, Provider $provider): Response
    {
        return $this->withErrorHandling(function () use ($request) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
        });
    }
}
