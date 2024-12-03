<?php

namespace App\Services;

use App\Models\Provider;
use Spatie\Url\Url;

class ProviderService
{
    public static function testProvider(Provider $provider): string
    {
        $url = Url::fromString($provider->authorization_endpoint)
            ->withQueryParameters([
                'response_type' => 'code',
                'client_id' => $provider->client_id,
                'redirect_uri' => route('login.callback', [
                    'provider' => $provider,
                ]),
                'scope' => collect($provider->scopes)->implode(' '),
            ]);

        return $url->__toString();
    }
}
