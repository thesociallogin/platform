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
        public string $userId,
        public array $attributes,
    ) {
        $this->setIdentifier($this->userId);
        $this->setClaims($this->attributes);
    }

    public static function fromModel(UserModel $user): User
    {
        return new self($user->getAuthIdentifier(), $user->getClaims());
    }
}
