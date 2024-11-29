<?php

namespace App\Data\Connections;

use App\Models\Connection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use Spatie\LaravelData\Data;

class Client extends Data implements ClientEntityInterface
{
    use ClientTrait, EntityTrait;

    public function __construct(
        public Connection $connection
    ) {
        $this->setIdentifier($this->connection->getKey());

        $this->name = $this->connection->name;
        $this->isConfidential = true;
        $this->redirectUri = $this->connection->redirect_url;
    }

    public static function fromModel(Connection $connection): Client
    {
        return new self(
            connection: $connection,
        );
    }
}
