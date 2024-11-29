<?php

namespace App\Providers\Identity;

use App\Contracts\Connections\IdentityProvider;
use App\Models\Provider;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class OAuth2 extends AbstractProvider implements IdentityProvider
{
    public function __construct(protected Request $request, protected Provider $provider)
    {
        $this->clientId = $this->provider->client_id;
        $this->clientSecret = $this->provider->client_secret;
        $this->redirectUri = $this->provider->redirect_url;

        return parent::__construct();
    }

    public function setupAuthorizationRedirect(): string
    {
        $authorizationUrl = $this->getAuthorizationUrl();

        $this->request->session()->put('oauth2state', $this->getState());
        $this->request->session()->put('oauth2pkceCode', $this->getPkceCode());

        return $authorizationUrl;
    }

    public function getBaseAuthorizationUrl(): ?string
    {
        return $this->provider->authorization_endpoint;
    }

    public function getBaseAccessTokenUrl(array $params): ?string
    {
        return $this->provider->token_endpoint;
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): ?string
    {
        return $this->provider->userinfo_endpoint;
    }

    protected function getDefaultScopes()
    {
        // TODO: Implement getDefaultScopes() method.
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        // TODO: Implement checkResponse() method.
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        // TODO: Implement createResourceOwner() method.
    }
}
