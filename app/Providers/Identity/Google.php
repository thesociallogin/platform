<?php

namespace App\Providers\Identity;

use App\Contracts\Connections\IdentityProvider;
use App\Models\Provider;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google as GoogleProvider;

class Google extends GoogleProvider implements IdentityProvider
{
    public function respondToLoginRequest(Request $request, Team $team, Provider $provider): RedirectResponse
    {
        $google = new self([
            'clientID' => $provider->client_id,
            'clientSecret' => $provider->client_secret,
            'redirectUri' => route('login.oauth.callback', [
                'provider' => $provider,
                'team' => $team,
            ]),
        ]);

        return new RedirectResponse($google->getAuthorizationUrl());
    }
}
