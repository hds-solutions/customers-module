<?php

namespace HDSSolutions\Finpar\Seeders;

class CustomersPermissionsSeeder extends Base\PermissionsSeeder {

    public function __construct() {
        parent::__construct('customers');
    }

    protected function permissions():array {
        return [
            $this->resource('customers'),
            $this->resource('providers'),
        ];
    }

    protected function afterRun():void {
        // create Partners Manager role
        $this->role('Partners Manager', [
            'customers.*',
            'providers.*',
        ]);
    }

}