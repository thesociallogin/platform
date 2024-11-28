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
        public string $connectionId,
        public string $connectionName,
        public string|array $connectionRedirectUrl
    ) {
        $this->setIdentifier($this->connectionId);

        $this->name = $this->connectionName;
        $this->isConfidential = true;
        $this->redirectUri = $this->connectionRedirectUrl;
    }

    public static function fromModel(Connection $connection): Client
    {
        return new self(
            connectionId: $connection->getKey(),
            connectionName: $connection->name,
            connectionRedirectUrl: $connection->redirect_url,
        );
    }
}
