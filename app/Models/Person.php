<?php

namespace HDSSolutions\Laravel\Models;

class Person extends X_Person {

    public function customer() {
        return $this->hasOne(Customer::class, 'id')
            ->select('customers.*');
    }

    public function provider() {
        return $this->hasOne(Provider::class, 'id')
            ->select('providers.*');
    }

    public function employee() {
        return $this->hasOne(Employee::class, 'id')
            ->select('employees.*');
    }

}
