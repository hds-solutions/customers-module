<?php

use HDSSolutions\Laravel\Http\Controllers\{
    PersonController,
    CustomerController,
    ProviderController,
    EmployeeController,
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

    Route::resource('customers',        CustomerController::class,  $name_prefix)
        ->only([ 'index', 'edit', 'delete' ])
        ->parameters([ 'customers' => 'resource' ])
        ->name('index', 'backend.customers');

    Route::resource('providers',        ProviderController::class,  $name_prefix)
        ->only([ 'index', 'edit', 'delete' ])
        ->parameters([ 'providers' => 'resource' ])
        ->name('index', 'backend.providers');

    Route::resource('employees',        EmployeeController::class,  $name_prefix)
        ->only([ 'index', 'edit', 'delete' ])
        ->parameters([ 'employees' => 'resource' ])
        ->name('index', 'backend.employees');

});
