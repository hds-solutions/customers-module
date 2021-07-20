<?php

namespace hDSSolutions\Laravel\Models\Policies;

use HDSSolutions\Laravel\Models\Provider as Resource;
use HDSSolutions\Laravel\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProviderPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('providers.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('providers.crud.show');
    }

    public function create(User $user) {
        return $user->can('providers.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('providers.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('providers.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('providers.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('providers.crud.destroy');
    }
}
