<?php

namespace App\Providers;

use App\Contracts\Connections\ConnectionAuthorizationServerInterface;
use App\Contracts\Connections\IdentityProvider;
use App\Contracts\Connections\IdentityRepositoryInterface;
use App\Guards\ConnectionGuard;
use App\Http\Controllers\Login\AuthorizationController;
use App\Http\Controllers\Login\CallbackController;
use App\Http\Responses\IdTokenResponse;
use App\Models\Provider;
use App\Repositories\Connections\AccessTokenRepository;
use App\Repositories\Connections\AuthCodeRepository;
use App\Repositories\Connections\ClientRepository;
use App\Repositories\Connections\IdentityRepository;
use App\Repositories\Connections\RefreshTokenRepository;
use App\Repositories\Connections\ScopeRepository;
use App\Server\ConnectionAuthorizationServer;
use App\Services\ConnectionService;
use DateInterval;
use DateMalformedIntervalStringException;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\GrantTypeInterface;
use League\OAuth2\Server\ResourceServer;

class ConnectionProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->bind(IdentityRepositoryInterface::class, IdentityRepository::class);

        $this->app->when(AuthorizationController::class)
            ->needs(StatefulGuard::class)
            ->give(fn () => Auth::guard('web'));

        $this->app->when(AuthorizationController::class)
            ->needs(IdentityProvider::class)
            ->give(function (Application $application) {
                /** @var Provider $provider */
                $provider = $application->make('request')->route('provider');

                return $application->makeWith($provider->provider->getProvider(), [
                    'provider' => $provider,
                ]);
            });

        $this->app->when(CallbackController::class)
            ->needs(IdentityProvider::class)
            ->give(function (Application $application) {
                /** @var Provider $provider */
                $provider = $application->make('request')->route('provider');

                return $application->makeWith($provider->provider->getProvider(), [
                    'provider' => $provider,
                ]);
            });

        $this->registerAuthorizationServer();
        $this->registerGuard();
    }

    protected function registerAuthorizationServer(): void
    {
        $this->app->singleton(ConnectionAuthorizationServerInterface::class, function () {
            return tap($this->makeAuthorizationServer(), function (ConnectionAuthorizationServer $server) {
                $server->setDefaultScope(ConnectionService::$defaultScope);
                $server->enableGrantType(
                    grantType: $this->makeAuthCodeGrant(),
                    accessTokenTTL: new DateInterval('P1Y')
                );
            });
        });
    }

    /**
     * @throws BindingResolutionException
     */
    protected function makeAuthorizationServer(): ConnectionAuthorizationServer
    {
        return new ConnectionAuthorizationServer(
            clientRepository: $this->app->make(ClientRepository::class),
            accessTokenRepository: $this->app->make(AccessTokenRepository::class),
            scopeRepository: $this->app->make(ScopeRepository::class),
            privateKey: new CryptKey(
                keyPath: storage_path('connection-private.key'),
                passPhrase: null,
                keyPermissionsCheck: true
            ),
            encryptionKey: $this->app->make('encrypter')->getKey(),
            responseType: $this->app->make(IdTokenResponse::class)
        );
    }

    /**
     * @throws BindingResolutionException
     */
    protected function registerGuard(): void
    {
        Auth::resolved(function (AuthManager $auth) {
            $auth->extend('connection', function ($app, $name, array $config) {
                return tap($this->makeGuard($config), function (ConnectionGuard $guard) {
                    App::refresh('request', $guard, 'setRequest');
                });
            });
        });
    }

    /**
     * @throws BindingResolutionException
     */
    protected function makeGuard(array $config): ConnectionGuard
    {
        return new ConnectionGuard(
            $this->app->make(ResourceServer::class),
            $this->app->make(UserProvider::class),
            $this->app->make('encrypter'),
            $this->app->make('request')
        );
    }

    /**
     * @throws BindingResolutionException
     * @throws DateMalformedIntervalStringException
     */
    protected function makeAuthCodeGrant(): AuthCodeGrant
    {
        return tap($this->buildAuthCodeGrant(), function (GrantTypeInterface $grant) {
            $grant->setRefreshTokenTTL(
                refreshTokenTTL: new DateInterval('P1Y')
            );
        });
    }

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    protected function buildAuthCodeGrant(): AuthCodeGrant
    {
        return new AuthCodeGrant(
            authCodeRepository: $this->app->make(AuthCodeRepository::class),
            refreshTokenRepository: $this->app->make(RefreshTokenRepository::class),
            authCodeTTL: new DateInterval('PT10M')
        );
    }
}
