<?php

namespace HDSSolutions\Finpar\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CustomersMenu {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // create a submenu
        $sub = backend()->menu()
            ->add(__('customers::customers.nav'), [
                'icon'  => 'cogs',
            ])->data('priority', 700);

        $this
            // append items to submenu
            ->customers($sub)
            ->providers($sub);

        // continue witn next middleware
        return $next($request);
    }

    private function customers(&$menu) {
        if (Route::has('backend.customers'))
            $menu->add(__('customers::customers.nav'), [
                'route'     => 'backend.customers',
                'icon'      => 'customers'
            ]);

        return $this;
    }

    private function providers(&$menu) {
        if (Route::has('backend.providers'))
            $menu->add(__('customers::providers.nav'), [
                'route'     => 'backend.providers',
                'icon'      => 'providers'
            ]);

        return $this;
    }

}
