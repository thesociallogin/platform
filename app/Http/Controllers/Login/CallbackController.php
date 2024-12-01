<?php

namespace App\Http\Controllers\Login;

use App\Contracts\Connections\IdentityProvider;
use App\Contracts\Connections\IdentityResourceOwnerInterface;
use App\Exceptions\IdentityProviderException;
use App\Filament\Account\Pages\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallbackController extends Controller
{
    use HandlesConnectionReturn;
    use HandlesOAuthClientErrors;
    use HandlesResourceOwnerActions;
    use ValidatesOAuthCallback;

    public function __construct(
        protected IdentityProvider $identityProvider
    ) {}

    /**
     * @throws IdentityProviderException
     */
    public function __invoke(Request $request, Provider $provider): RedirectResponse
    {
        $authCode = $this->validateAuthorizationCode($request);

        $this->validateState($request);

        $accessToken = $this->identityProvider->getAccessToken('authorization_code', [
            'code' => $authCode,
        ]);

        /** @var IdentityResourceOwnerInterface $resourceOwner */
        $resourceOwner = $this->identityProvider->getResourceOwner($accessToken);

        $this->createOrUpdateUser($resourceOwner, function (User $user) {
            Auth::loginUsingId($user->getAuthIdentifier());
        });

        if ($redirect = $this->handleConnectionReturn($request)) {
            return $redirect;
        }

        return redirect(Dashboard::getUrl(panel: 'account'));
    }
}
