<?php

namespace App\Data\Connections;

use App\Models\ConnectionAccessToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;
use Spatie\LaravelData\Data;

class AccessToken extends Data implements AccessTokenEntityInterface
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;

    public function __construct(
        public ?string $userId,
        public array $requestedScopes,
        public ClientEntityInterface $tokenClient
    ) {
        $this->setUserIdentifier($this->userId);
        $this->setClient($this->tokenClient);

        foreach ($this->requestedScopes as $scope) {
            $this->addScope($scope);
        }
    }

    public function fromModel(ConnectionAccessToken $token): AccessToken
    {
        return new self(
            userId: $token->user_id,
            requestedScopes: $token->scopes,
            tokenClient: Client::from($token->connection),
        );
    }
}
