<?php

namespace App\Data\Connections;

use App\Models\ConnectionAccessToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use Spatie\LaravelData\Data;

class AccessToken extends Data implements AccessTokenEntityInterface
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;

    public function __construct(
        public ConnectionAccessToken $connectionAccessToken,
    ) {
        $this->setUserIdentifier($this->connectionAccessToken->user_id);
        $this->setClient(Client::from($this->connectionAccessToken->connection));

        foreach ($this->connectionAccessToken->scopes as $scope) {
            $this->addScope(Scope::from($scope));
        }
    }

    public function fromModel(ConnectionAccessToken $connectionAccessToken): AccessToken
    {
        return new self(
            connectionAccessToken: $connectionAccessToken,
        );
    }
}
