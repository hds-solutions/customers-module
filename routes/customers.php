<?php

use HDSSolutions\Finpar\Http\Controllers\CustomerController;
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

});