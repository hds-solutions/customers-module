<?php

namespace HDSSolutions\Finpar\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CustomersMenu extends Base\Menu {

    public function handle($request, Closure $next) {
        // create a submenu
        $sub = backend()->menu()
            ->add(__('customers::people.nav'), [
                'icon'  => 'cogs',
            ])->data('priority', 700);

        $this
            // append items to submenu
            ->people($sub)
            ->customers($sub)
            ->providers($sub)
            ->employees($sub);

        // continue witn next middleware
        return $next($request);
    }

    private function people(&$menu) {
        if (Route::has('backend.people') && $this->can('people'))
            $menu->add(__('customers::people.nav'), [
                'route'     => 'backend.people',
                'icon'      => 'people'
            ]);

        return $this;
    }

    private function customers(&$menu) {
        if (Route::has('backend.customers') && $this->can('customers'))
            $menu->add(__('customers::customers.nav'), [
                'route'     => 'backend.customers',
                'icon'      => 'customers'
            ]);

        return $this;
    }

    private function providers(&$menu) {
        if (Route::has('backend.providers') && $this->can('providers'))
            $menu->add(__('customers::providers.nav'), [
                'route'     => 'backend.providers',
                'icon'      => 'providers'
            ]);

        return $this;
    }

    private function employees(&$menu) {
        if (Route::has('backend.employees') && $this->can('employees'))
            $menu->add(__('customers::employees.nav'), [
                'route'     => 'backend.employees',
                'icon'      => 'employees'
            ]);

        return $this;
    }

}
