<?php

namespace App\Repositories\Connections;

use App\Data\Connections\Client;
use App\Models\Connection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function getClientEntity($clientIdentifier): ?ClientEntityInterface
    {
        /** @var ?Connection $connection */
        $connection = Connection::find($clientIdentifier);

        if (blank($connection)) {
            return null;
        }

        return Client::from($connection);
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType): bool
    {
        return true;
    }
}
