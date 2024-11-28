<?php

namespace App\Contracts\Connections;

use League\OAuth2\Server\Repositories\RepositoryInterface;

interface IdentityRepositoryInterface extends RepositoryInterface
{
    public function getIdentityEntityByIdentifier($userIdentifier): ?IdentityEntityInterface;
}
