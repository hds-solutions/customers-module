<?php

namespace hDSSolutions\Laravel\Models\Policies;

use HDSSolutions\Laravel\Models\Customer as Resource;
use HDSSolutions\Laravel\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('customers.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('customers.crud.show');
    }

    public function create(User $user) {
        return $user->can('customers.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('customers.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('customers.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('customers.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('customers.crud.destroy');
    }
}
