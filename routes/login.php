<?php

use App\Http\Controllers\Login\AccessTokenController;
use App\Http\Controllers\Login\AuthorizationController;
use App\Http\Controllers\Login\CallbackController;

Route::group(['prefix' => '{provider}'], function () {
    Route::group(['middleware' => 'web'], function () {
        Route::get('/authorize', AuthorizationController::class)
            ->name('authorize');

        Route::get('callback', CallbackController::class)
            ->name('callback');
    });

    Route::post('/token', AccessTokenController::class)
        ->middleware('throttle')
        ->name('token');
});
