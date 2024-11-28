<?php

namespace App\Guards;

use App\Models\Connection;
use App\Models\ConnectionAccessToken;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use League\OAuth2\Server\ResourceServer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class ConnectionGuard implements Guard
{
    use GuardHelpers, Macroable;

    public function __construct(
        protected ResourceServer $server,
        protected $provider,
        protected Encrypter $encrypter,
        protected Request $request
    ) {
        dd($this->server, $this->provider, $this->encrypter, $this->request);
    }

    public function user(): ?Authenticatable
    {
        if (! is_null($this->user)) {
            return $this->user;
        }

        if ($this->request->bearerToken()) {
            if ($user = $this->authenticateViaBearerToken($this->request)) {
                return $this->user = $user;
            }
        }

        return null;
    }

    protected function authenticateViaBearerToken(Request $request): ?Authenticatable
    {
        if (! $psr = $this->getPsrRequestViaBearerToken($request)) {
            return null;
        }

        $connection = Connection::active()->find($psr->getAttribute('oauth_client_id'));

        if (blank($connection)) {
            return null;
        }

        $user = $this->provider->retrieveById(
            $psr->getAttribute('oauth_user_id') ?: null
        );

        if (blank($user)) {
            return null;
        }

        $token = ConnectionAccessToken::find($psr->getAttribute('oauth_access_token_id'));

        return $token
            ? $user->withAccessToken($token) :
            null;
    }

    protected function getPsrRequestViaBearerToken(Request $request): ServerRequestInterface
    {
        $psr = (new PsrHttpFactory(
            new Psr17Factory,
            new Psr17Factory,
            new Psr17Factory,
            new Psr17Factory
        ))->createRequest($request);

        return rescue(fn () => $this->server->validateAuthenticatedRequest($psr), function () use ($request) {
            $request->headers->set('Authorization', '');
        });
    }

    public function validate(array $credentials = []): bool
    {
        return filled((new static(
            $this->server,
            $this->provider,
            $this->encrypter,
            $credentials['request'],
        ))->user());
    }
}
