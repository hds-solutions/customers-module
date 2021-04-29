<?php

namespace HDSSolutions\Finpar\Models;

class Person extends X_Person {

    public function customer() {
        return $this->hasOne(Customer::class, 'id');
    }

    public function provider() {
        return $this->hasOne(Provider::class, 'id');
    }

    public function employee() {
        return $this->hasOne(Employee::class, 'id');
    }

}
