<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\IdentityProvider;
use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class CallbackController extends Controller
{
    public function __construct(
        protected IdentityProvider $identityProvider
    ) {}

    public function __invoke(Request $request, Provider $provider)
    {
        if (! $code = $request->input('code')) {
            abort(403, 'No authorization code present in URL.');
        }

        if ($request->session()->get('oauth2state') !== $request->input('state')) {
            $request->session()->forget('oauth2state');

            abort(403, 'Invalid state.');
        }

        try {
            $accessToken = $this->identityProvider->getAccessToken('authorization_code', [
                'code' => $code,
            ]);

            // TODO: Handle user registration/creation when coming back from external IDP
            Auth::login(User::first());

            if ($connectionRequest = $request->session()->get('connectionrequest')) {
                /** @var ConnectionRequest $connectionRequest */
                $connectionRequest = ConnectionRequest::findOrFail($connectionRequest);

                return redirect()->to($connectionRequest->redirect_url);
            }
        } catch (IdentityProviderException $exception) {

        }
    }
}
