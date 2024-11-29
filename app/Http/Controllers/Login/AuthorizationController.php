<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\ConnectionAuthorizationServerInterface;
use App\Contracts\Connections\IdentityProvider;
use App\Data\Connections\Client;
use App\Data\Connections\User;
use App\Exceptions\ConnectionAuthenticationException;
use App\Exceptions\ConnectionServerException;
use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use App\Models\Provider;
use App\Models\User as UserModel;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizationController extends Controller
{
    use HandlesOAuthErrors;

    public function __construct(
        protected ConnectionAuthorizationServerInterface $server,
        protected StatefulGuard $guard,
        protected IdentityProvider $identityProvider,
    ) {
        //
    }

    /**
     * @throws ConnectionServerException
     * @throws ConnectionAuthenticationException
     */
    public function __invoke(ServerRequestInterface $psrRequest, Request $request, Provider $provider): Response
    {
        /** @var AuthorizationRequest $authRequest */
        $authRequest = $this->withErrorHandling(function () use ($psrRequest) {
            return $this->server->validateAuthorizationRequest($psrRequest);
        });

        /** @var Client $client */
        $client = $authRequest->getClient();

        if (blank($client->connection)) {
            abort(401, 'We could not identify the connection making the request.');
        }

        if (! $client->connection->providers->contains($provider->getKey())) {
            abort(401, 'The provider being requested is not assigned to the connection making the request.');
        }

        if ($this->guard->guest()) {
            $connectionRequest = ConnectionRequest::create([
                'redirect_url' => $request->getRequestUri(),
            ]);

            $request->session()->put('connectionrequest', $connectionRequest->getKey());

            return $this->promptForLogin($request);
        }

        /** @var UserModel $user */
        $user = $this->guard->user();

        return $this->approveRequest($authRequest, $user);
    }

    protected function approveRequest(AuthorizationRequest $authRequest, UserModel $user): Response
    {
        $authRequest->setUser(User::from($user));
        $authRequest->setAuthorizationApproved(true);

        return $this->withErrorHandling(function () use ($authRequest) {
            return $this->convertResponse(
                response: $this->server->completeAuthorizationRequest($authRequest, new Psr7Response)
            );
        });
    }

    /**
     * @throws ConnectionAuthenticationException
     */
    protected function promptForLogin(Request $request)
    {
        $request->session()->put('promptedForLogin', true);

        throw new ConnectionAuthenticationException($this->identityProvider);
    }
}