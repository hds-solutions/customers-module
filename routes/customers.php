<?php

use HDSSolutions\Finpar\Http\Controllers\{
    PersonController,
    ProviderController,
};
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'        => config('backend.prefix'),
    'middleware'    => [ 'web', 'auth:'.config('backend.guard') ],
], function() {
    // name prefix
    $name_prefix = [ 'as' => 'backend' ];

    Route::resource('people',           PersonController::class,    $name_prefix)
        ->parameters([ 'people' => 'resource' ])
        ->name('index', 'backend.people');

    // Route::resource('providers',        ProviderController::class,  $name_prefix)
    //     ->parameters([ 'providers' => 'resource' ])
    //     ->name('index', 'backend.providers');

});
