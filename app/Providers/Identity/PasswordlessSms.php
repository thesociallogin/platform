<?php

namespace App\Providers\Identity;

use App\Contracts\Connections\IdentityProvider;
use App\Models\Provider;
use Illuminate\Http\Request;

class PasswordlessSms implements IdentityProvider
{
    public function __construct(protected Request $request, protected Provider $provider)
    {
        //
    }

    public function setupAuthorizationRedirect(): string
    {
        return route('login.passwordless.sms.index', [
            'provider' => $this->provider,
        ]);
    }
}
