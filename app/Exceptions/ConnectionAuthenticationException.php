<?php

namespace App\Exceptions;

use App\Contracts\Connections\IdentityProvider;
use Illuminate\Auth\AuthenticationException;

class ConnectionAuthenticationException extends AuthenticationException
{
    public function __construct(IdentityProvider $identityProvider)
    {
        static::redirectUsing(fn () => $identityProvider->setupAuthorizationRedirect());

        parent::__construct('Unauthenticated');
    }
}
