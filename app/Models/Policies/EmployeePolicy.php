<?php

namespace hDSSolutions\Finpar\Models\Policies;

use HDSSolutions\Finpar\Models\Employee as Resource;
use HDSSolutions\Finpar\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('employees.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('employees.crud.show');
    }

    public function create(User $user) {
        return $user->can('employees.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('employees.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('employees.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('employees.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('employees.crud.destroy');
    }
}
