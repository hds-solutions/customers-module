<?php

namespace hDSSolutions\Laravel\Models\Policies;

use HDSSolutions\Laravel\Models\Person as Resource;
use HDSSolutions\Laravel\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('people.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('people.crud.show');
    }

    public function create(User $user) {
        return $user->can('people.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('people.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('people.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('people.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('people.crud.destroy');
    }
}
