<?php

namespace App\Http\Responses;

use App\Contracts\Connections\IdentityRepositoryInterface;
use App\Data\Connections\Scope;
use DateTimeImmutable;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse;

class IdTokenResponse extends BearerTokenResponse
{
    use IdTokenTrait;

    public function __construct(
        protected IdentityRepositoryInterface $identityProvider,
    ) {
        //
    }

    /**
     * @return string[]
     */
    protected function getExtraParams(AccessTokenEntityInterface $accessToken): array
    {
        if (! $this->isOpenIdRequest($accessToken->getScopes())) {
            return [];
        }

        return [
            'id_token' => $this->convertToJWT()->toString(),
        ];
    }

    /**
     * @param  Scope[]  $scopes
     */
    private function isOpenIdRequest(array|Scope $scopes): bool
    {
        return filled(collect($scopes)->first(fn (Scope $scope) => $scope->getIdentifier() === 'openid'));
    }

    public function getClient(): ClientEntityInterface
    {
        return $this->accessToken->getClient();
    }

    public function getExpiryDateTime(): DateTimeImmutable
    {
        return $this->accessToken->getExpiryDateTime();
    }

    public function getUserIdentifier(): int|string
    {
        $identityEntity = $this->identityProvider->getIdentityEntityByIdentifier($this->accessToken->getUserIdentifier());

        return $identityEntity->getIdentifier();
    }

    public function getClaims(): array
    {
        $identityEntity = $this->identityProvider->getIdentityEntityByIdentifier($this->accessToken->getUserIdentifier());

        return $identityEntity->getClaims();
    }
}
