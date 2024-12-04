<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'web.'], function () {
    Route::get('/', HomeController::class)->name('home');
});
