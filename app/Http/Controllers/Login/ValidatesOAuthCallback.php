<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

trait ValidatesOAuthCallback
{
    protected function validateAuthorizationCode(Request $request): string
    {
        if (! $code = $request->input('code')) {
            abort(403, 'No authorization code present in URL.');
        }

        return $code;
    }

    protected function validateState(Request $request): void
    {
        if ($request->session()->get('oauth2state') !== $request->input('state')) {
            $request->session()->forget('oauth2state');

            abort(403, 'Invalid state.');
        }
    }
}
