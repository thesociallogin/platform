<?php

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\Users\UsersController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::get('me', MeController::class)->name('me');
Orion::resource('users', UsersController::class);
