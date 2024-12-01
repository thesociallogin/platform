<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\IdentityResourceOwnerInterface;
use App\Models\User;
use Closure;

trait HandlesResourceOwnerActions
{
    protected function createOrUpdateUser(IdentityResourceOwnerInterface $resourceOwner, Closure $callback)
    {
        $user = User::firstOrCreate([
            'id' => $resourceOwner->getId(),
        ]);

        return value($callback, $user);
    }
}
