<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\CustomerDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Customer as Resource;

class CustomerController extends Controller {

    public function __construct() {
        // check resource Policy
        $this->authorizeResource(Resource::class, 'resource');
    }

    public function index(Request $request, DataTable $dataTable) {
        // check only-form flag
        if ($request->has('only-form'))
            // redirect to popup callback
            return view('backend::components.popup-callback', [ 'resource' => new Resource ]);

        // load resources
        if ($request->ajax()) return $dataTable->ajax();

        // return view with dataTable
        return $dataTable->render('customers::customers.index', [
            'count'                 => Resource::count(),
            'show_company_selector' => !backend()->companyScoped(),
        ]);
    }

    public function create(Request $request) {
        // force company selection
        if (!backend()->companyScoped()) return view('backend::layouts.master', [ 'force_company_selector' => true ]);

        // redirect to People.create route
        return redirect()->action([ PersonController::class, 'create' ], $request->query());
    }

    public function edit(Request $request, Resource $resource) {
        // redirect to People.edit route
        return redirect()->action([ PersonController::class, 'edit' ], [ 'resource' => $resource ] + $request->query());
    }

    public function destroy(Request $request, Resource $resource) {
        // disable Person as customer
        if (!$resource->delete(with_identity: false))
            // return back with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        // redirect to Customers list
        return redirect()->route('backend.customers');
    }

}
