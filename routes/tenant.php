<?php

use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::group([
    'prefix' => '/{tenant}',
    'middleware' => ['api', InitializeTenancyByPath::class],
], function () {

    require __DIR__ . '/shared.php';

    /**
     * Only tenant domain can access these routes
     */
});