<?php

namespace App\Http\Controllers\Login\Passwordless\Sms;

use App\Actions\SendOneTimeCode;
use App\Models\Enums\OneTimeCodeType;
use App\Models\Provider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class SendController implements HasMiddleware
{
    public function index(Provider $provider): Response
    {
        return Inertia::render('passwordless/sms', [
            'provider' => $provider->id,
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request, Provider $provider): RedirectResponse
    {
        $data = Validator::validate($request->all(), [
            'email' => ['required', 'email'],
        ]);

        SendOneTimeCode::handle(
            emailOrPhoneNumber: data_get($data, 'email'),
            type: OneTimeCodeType::SMS
        );

        return redirect()->to(
            path: URL::signedRoute('login.passwordless.login.index', [
                'provider' => $provider,
            ])
        )->with('status', __('If you have an account with us, we have sent a text message to the phone number provided.'));
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
