<?php

use HDSSolutions\Finpar\Http\Controllers\{
    CustomerController,
    ProviderController,
};
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'        => config('backend.prefix'),
    'middleware'    => [ 'web', 'auth:'.config('backend.guard') ],
], function() {
    // name prefix
    $name_prefix = [ 'as' => 'backend' ];

    Route::resource('customers',        CustomerController::class,  $name_prefix)
        ->parameters([ 'customers' => 'resource' ])
        ->name('index', 'backend.customers');

    Route::resource('providers',        ProviderController::class,  $name_prefix)
        ->parameters([ 'providers' => 'resource' ])
        ->name('index', 'backend.providers');

});
