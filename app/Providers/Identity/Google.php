<?php

namespace App\Providers\Identity;

use App\Contracts\Connections\IdentityProvider;
use App\Models\Provider;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google as GoogleProvider;

class Google extends GoogleProvider implements IdentityProvider
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
        return $this->getAuthorizationUrl();
    }
}
