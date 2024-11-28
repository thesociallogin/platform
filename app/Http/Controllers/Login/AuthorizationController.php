<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\ConnectionAuthorizationServerInterface;
use App\Data\Connections\User;
use App\Exceptions\ConnectionAuthenticationException;
use App\Exceptions\ConnectionServerException;
use App\Http\Controllers\Controller;
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
        protected StatefulGuard $guard
    ) {
        //
    }

    /**
     * @throws ConnectionServerException
     */
    public function __invoke(ServerRequestInterface $psrRequest, Request $request, Provider $provider): Response
    {
        $authRequest = $this->withErrorHandling(function () use ($psrRequest) {
            return $this->server->validateAuthorizationRequest($psrRequest);
        });

        $this->guard->login(UserModel::first());

        if ($this->guard->guest()) {
            //return $this->promptForLogin($request, $provider);
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
    protected function promptForLogin(Request $request, Provider $provider)
    {
        $request->session()->put('promptedForLogin', true);

        throw new ConnectionAuthenticationException($provider);
    }
}
