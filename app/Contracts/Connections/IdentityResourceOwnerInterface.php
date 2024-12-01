<?php

namespace App\Contracts\Connections;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

interface IdentityResourceOwnerInterface extends ResourceOwnerInterface
{
    public function getName();

    public function getEmail();
}
