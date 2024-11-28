<?php

namespace App\Repositories\Connections;

use App\Data\Connections\Scope;
use App\Models\Connection;
use App\Services\ConnectionService;
use Illuminate\Support\Collection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{
    public function getScopeEntityByIdentifier($identifier): ?ScopeEntityInterface
    {
        if (! ConnectionService::hasScope($identifier)) {
            return null;
        }

        return Scope::from([
            'scope' => $identifier,
        ]);
    }

    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null)
    {
        $connection = Connection::active()->whereKey($clientEntity->getIdentifier())->first();

        return collect($scopes)->filter(function (ScopeEntityInterface $scope) {
            return ConnectionService::hasScope($scope);
        })->when($connection, function (Collection $scopes, Connection $connection) {
            return $scopes->filter(fn (ScopeEntityInterface $scope) => ConnectionService::connectionHasScope($connection, $scope));
        })->values()->all();
    }
}
