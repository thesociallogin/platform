<?php

namespace App\Data\Connections;

use App\Contracts\Connections\IdentityEntityInterface;
use App\Data\Connections\Traits\ClaimsTrait;
use App\Models\User as UserModel;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Spatie\LaravelData\Data;

class User extends Data implements IdentityEntityInterface, UserEntityInterface
{
    use ClaimsTrait, EntityTrait;

    public function __construct(
        public UserModel $user,
    ) {
        $this->setIdentifier($this->user->getAuthIdentifier());
        $this->setClaims($this->user->getClaims());
    }

    public static function fromModel(UserModel $user): User
    {
        return new self(
            user: $user
        );
    }
}
