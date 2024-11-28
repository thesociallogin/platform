<?php

namespace App\Services;

use App\Data\Connections\Scope;
use App\Models\Connection;
use Illuminate\Support\Arr;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

class ConnectionService
{
    /**
     * @var array|string[]
     */
    public static array $scopes = [
        'openid' => 'Can sign you on',
        'profile' => 'Can access your profile',
        'email' => 'Can access your email',
    ];

    public static string $defaultScope = 'openid profile email';

    public static function setDefaultScope(string|array $scope): void
    {
        static::$defaultScope = implode(' ', Arr::wrap($scope));
    }

    /**
     * Determines if the scope can be requested.
     */
    public static function hasScope($scope): bool
    {
        if ($scope instanceof ScopeEntityInterface) {
            $scope = $scope->getIdentifier();
        }

        return $scope === '*' || array_key_exists($scope, static::$scopes);
    }

    /**
     * Determines if the scope provided can be requested using the client/connection.
     */
    public static function connectionHasScope(Connection $connection, string|ScopeEntityInterface $scope): bool
    {
        if ($scope instanceof ScopeEntityInterface) {
            $scope = $scope->getIdentifier();
        }

        $acceptableScopes = Arr::wrap($connection->scopes);

        if (in_array('*', $acceptableScopes) || blank($acceptableScopes)) {
            return true;
        }

        return in_array($scope, $acceptableScopes);
    }

    /**
     * @return Scope[]
     */
    public static function scopes(): array
    {
        return collect(static::$scopes)->map(function (string $description, string $identifier) {
            return Scope::from([
                'identifier' => $identifier,
                'description' => $description,
            ]);
        })->values();
    }
}
