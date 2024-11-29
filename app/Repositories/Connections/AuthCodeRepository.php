<?php

namespace App\Repositories\Connections;

use App\Data\Connections\AuthCode;
use App\Models\ConnectionAuthCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function getNewAuthCode(): AuthCodeEntityInterface
    {
        return AuthCode::from(AuthCode::empty());
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
    {
        ConnectionAuthCode::create([
            'id' => $authCodeEntity->getIdentifier(),
            'user_id' => $authCodeEntity->getUserIdentifier(),
            'connection_id' => $authCodeEntity->getClient()->getIdentifier(),
            'scopes' => collect($authCodeEntity->getScopes())->map(fn (ScopeEntityInterface $scopeEntity) => $scopeEntity->getIdentifier())->toArray(),
            'revoked' => false,
            'expires_at' => $authCodeEntity->getExpiryDateTime(),
        ]);
    }

    public function revokeAuthCode($codeId): void
    {
        ConnectionAuthCode::whereKey($codeId)->update([
            'revoked' => true,
        ]);
    }

    public function isAuthCodeRevoked($codeId): bool
    {
        return ConnectionAuthCode::whereKey($codeId)->revoked()->exists();
    }
}
