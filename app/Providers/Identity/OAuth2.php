<?php

namespace App\Providers\Identity;

use App\Contracts\Connections\IdentityProvider;
use App\Contracts\Connections\IdentityResourceOwnerInterface;
use App\Exceptions\IdentityProviderException;
use App\Models\Provider;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class OAuth2 extends AbstractProvider implements IdentityProvider
{
    use BearerAuthorizationTrait;

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

    protected function getDefaultScopes(): string|array
    {
        return collect($this->provider->scopes)->implode(' ');
    }

    /**
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if ($response->getStatusCode() >= 400) {
            throw IdentityProviderException::withData($data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token): OAuth2ResourceOwner
    {
        return new OAuth2ResourceOwner($this->provider, $response);
    }
}

class OAuth2ResourceOwner implements IdentityResourceOwnerInterface
{
    use ArrayAccessorTrait;

    public function __construct(protected Provider $provider, protected array $response) {}

    public function getId()
    {
        return $this->getValueByKey($this->response, $this->provider->userinfo_id);
    }

    public function getName()
    {
        return $this->getValueByKey($this->response, $this->provider->userinfo_name);
    }

    public function getEmail()
    {
        return $this->getValueByKey($this->response, $this->provider->userinfo_email);
    }

    public function toArray(): array
    {
        return $this->response;
    }
}
