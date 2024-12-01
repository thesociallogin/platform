<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::domain(config('app.api_url'))
                ->as('api.')
                ->middleware('auth:api')
                ->namespace('App\\Http\\Controllers\\Api')
                ->group(base_path('routes/api.php'));

            Route::domain(config('app.login_url'))
                ->as('login.')
                ->namespace('App\\Http\\Controllers\\Login')
                ->group(base_path('routes/login.php'));

            Route::domain(config('app.account_url'))
                ->as('passport.')
                ->namespace('Laravel\\Passport\\Http\\Controllers')
                ->group(base_path('routes/passport.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('filament.account.auth.login'));
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
