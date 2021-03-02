<?php

namespace HDSSolutions\Finpar;

// use HDSSolutions\Finpar\Commands\Mix;
use HDSSolutions\Laravel\Modules\ModuleServiceProvider;

class CustomersModuleServiceProvider extends ModuleServiceProvider {

    private $commands = [
        // Mix::class,
    ];

    public function bootEnv():void {
        // enable config override
        $this->publishes([
            module_path('config/customers.php') => config_path('customers.php'),
        ], 'customers.config');

        // load routes
        $this->loadRoutesFrom( module_path('routes/customers.php') );
        // load views
        $this->loadViewsFrom( module_path('resources/views'), 'customers' );
        // load translations
        $this->loadTranslationsFrom( module_path('resources/lang'), 'customers' );
        // load migrations
        $this->loadMigrationsFrom( module_path('database/migrations') );
        // load seeders
        $this->loadSeedersFrom( module_path('database/seeders') );
    }

    public function register() {
        // register helpers
        if (file_exists($helpers = realpath(__DIR__.'/helpers.php')))
            //
            require_once $helpers;
        // register singleton
        app()->singleton('customers', fn() => new Customers);
        // register commands
        // $this->commands( $this->commands );
        // merge configuration
        $this->mergeConfigFrom( module_path('config/customers.php'), 'customers' );
    }

}
