<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\IdentityResourceOwnerInterface;
use App\Models\Provider;
use Closure;

trait HandlesResourceOwnerActions
{
    protected function createOrUpdateUser(IdentityResourceOwnerInterface $resourceOwner, Provider $provider, Closure $callback)
    {
        $user = $provider->users()->firstOrCreate([
            'id' => $resourceOwner->getId(),
        ], [
            'name' => $resourceOwner->getName(),
            'email' => $resourceOwner->getEmail(),
        ]);

        return value($callback, $user);
    }
}
