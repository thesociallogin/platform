<?php

namespace App\Http\Controllers\Login\Passwordless;

use App\Filament\Account\Pages\Dashboard;
use App\Http\Controllers\Login\HandlesConnectionReturn;
use App\Models\OneTimeCode;
use App\Models\Provider;
use App\Rules\Unexpired;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class LoginController implements HasMiddleware
{
    use HandlesConnectionReturn;

    public function index(Request $request, Provider $provider): Response
    {
        return Inertia::render('passwordless/login', [
            'provider' => $provider->id,
            'loginUri' => $request->getRequestUri(),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request, Provider $provider): \Symfony\Component\HttpFoundation\Response
    {
        $data = Validator::validate($request->all(), [
            'code' => ['required', 'exists:one_time_codes,code', new Unexpired(table: 'one_time_codes')],
        ], [
            'code.exists' => __('The code you provided is invalid.'),
        ]);

        $oneTimeCode = OneTimeCode::whereCode(data_get($data, 'code'))->firstOrFail();

        Auth::login($oneTimeCode->user);

        $oneTimeCode->delete();

        if ($redirect = $this->handleConnectionReturn($request)) {
            return Inertia::location($redirect);
        }

        return Inertia::location(Dashboard::getUrl(panel: 'account'));
    }

    /**
     * @return Middleware[]
     */
    public static function middleware(): array
    {
        return [
            new Middleware('throttle', only: ['store']),
        ];
    }
}
