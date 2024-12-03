<?php

use App\Http\Controllers\Login\AccessTokenController;
use App\Http\Controllers\Login\AuthorizationController;
use App\Http\Controllers\Login\CallbackController;
use App\Http\Controllers\Login\Passwordless\Email\SendController as EmailSendController;
use App\Http\Controllers\Login\Passwordless\LoginController;
use App\Http\Controllers\Login\Passwordless\Sms\SendController as SmsSendController;

Route::group(['prefix' => '{provider}'], function () {
    Route::group(['middleware' => 'web'], function () {
        Route::get('/authorize', AuthorizationController::class)
            ->name('authorize');

        Route::get('callback', CallbackController::class)
            ->name('callback');

        Route::group(['prefix' => 'passwordless', 'as' => 'passwordless.'], function () {
            Route::resource('email', EmailSendController::class)->only([
                'index',
                'store',
            ]);

            Route::resource('login', LoginController::class)->only([
                'index',
                'store',
            ])->middleware('signed');

            Route::resource('sms', SmsSendController::class)->only([
                'index',
                'store',
            ]);
        });
    });

    Route::post('/token', AccessTokenController::class)
        ->middleware('throttle')
        ->name('token');
});
