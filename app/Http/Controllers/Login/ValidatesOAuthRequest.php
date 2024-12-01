<?php

namespace App\Http\Controllers\Login;

use App\Data\Connections\Client;
use App\Models\Provider;

trait ValidatesOAuthRequest
{
    protected function validateConnection(Client $client, Provider $provider): void
    {
        if (blank($client->connection)) {
            abort(401, 'We could not identify the connection making the request.');
        }

        if (! $client->connection->providers->contains($provider->getKey())) {
            abort(401, 'The provider being requested is not assigned to the connection making the request.');
        }
    }
}
