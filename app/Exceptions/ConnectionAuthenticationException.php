<?php

namespace App\Exceptions;

use App\Models\Provider;
use Illuminate\Auth\AuthenticationException;

class ConnectionAuthenticationException extends AuthenticationException
{
    public function __construct(Provider $provider)
    {
        static::redirectUsing(function () {});

        parent::__construct('Unauthenticated');
    }
}
