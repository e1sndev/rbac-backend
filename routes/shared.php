<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/**
 * Shared routes for all domains
 */
Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login');
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('permissions', [PermissionController::class, 'index']);
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);

        Route::prefix('account')
            ->controller(AccountController::class)
            ->group(function () {
                Route::get('me', 'me');
                Route::post('logout', 'logout');
            });
    });