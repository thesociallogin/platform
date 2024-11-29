<?php

namespace App\Contracts\Connections;

interface IdentityProvider
{
    public function setupAuthorizationRedirect(): string;
}
