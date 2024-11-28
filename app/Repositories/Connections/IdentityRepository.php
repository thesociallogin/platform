<?php

namespace App\Repositories\Connections;

use App\Contracts\Connections\IdentityEntityInterface;
use App\Contracts\Connections\IdentityRepositoryInterface;
use App\Data\Connections\User;
use App\Models\User as UserModel;

class IdentityRepository implements IdentityRepositoryInterface
{
    public function getIdentityEntityByIdentifier($userIdentifier): ?IdentityEntityInterface
    {
        /** @var ?UserModel $user */
        $user = UserModel::find($userIdentifier);

        if (blank($userIdentifier)) {
            return null;
        }

        return User::from($user);
    }
}
