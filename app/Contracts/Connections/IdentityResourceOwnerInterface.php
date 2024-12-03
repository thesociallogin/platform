<?php

namespace App\Contracts\Connections;

use App\Models\Provider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

interface IdentityResourceOwnerInterface extends ResourceOwnerInterface
{
    public function getProvider(): Provider;

    public function getName(): string;

    public function getEmail(): string;
}
