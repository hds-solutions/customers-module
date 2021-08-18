<?php

namespace HDSSolutions\Laravel\Models;

class Employee extends X_Employee {

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pos() {
        return $this->belongsToMany(POS::class, 'pos_employee', 'employee_id', 'pos_id')
            ->using(POSEmployee::class)
            ->withTimestamps();
    }

}
