<?php

namespace App\Contracts\Connections;

interface IdentityEntityInterface
{
    public function getIdentifier();

    public function getClaims(): array;
}
