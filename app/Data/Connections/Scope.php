<?php

namespace App\Data\Connections;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use Spatie\LaravelData\Concerns\BaseData;
use Spatie\LaravelData\Contracts\BaseData as BaseDataContract;
use Spatie\LaravelData\Optional;

class Scope implements BaseDataContract, ScopeEntityInterface
{
    use BaseData, EntityTrait;

    public function __construct(
        public string $scope,
        public string|Optional $description
    ) {
        $this->setIdentifier($this->scope);
    }

    public function jsonSerialize(): string
    {
        return $this->getIdentifier();
    }
}
