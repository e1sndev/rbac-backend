<?php

use App\Http\Controllers\TenantController;

require __DIR__ . '/shared.php';

/**
 * Only central domain can access these routes
 */
Route::apiResource('tenants', TenantController::class, [
    'only' => ['index', 'store', 'destroy']
]);