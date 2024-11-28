<?php

namespace App\Repositories\Connections;

use App\Data\Connections\AccessToken;
use App\Models\ConnectionAccessToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null): AccessTokenEntityInterface
    {
        return AccessToken::from([
            'userId' => $userIdentifier,
            'requestedScopes' => $scopes,
            'tokenClient' => $clientEntity,
        ]);
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        ConnectionAccessToken::create([
            'user_id' => $accessTokenEntity->getUserIdentifier(),
            'connection_id' => $accessTokenEntity->getClient()->getIdentifier(),
            'scopes' => collect($accessTokenEntity->getScopes())->map(fn (ScopeEntityInterface $scopeEntity) => $scopeEntity->getIdentifier())->toArray(),
            'revoked' => false,
        ]);
    }

    public function revokeAccessToken($tokenId): void
    {
        ConnectionAccessToken::whereKey($tokenId)->update([
            'revoked' => true,
        ]);
    }

    public function isAccessTokenRevoked($tokenId): bool
    {
        return ConnectionAccessToken::whereKey($tokenId)->revoked()->exists();
    }
}
