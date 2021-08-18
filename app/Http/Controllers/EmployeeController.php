<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\EmployeeDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Employee as Resource;

class EmployeeController extends Controller {

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
        return $dataTable->render('customers::employees.index', [ 'count' => Resource::count() ]);
    }

    public function create(Request $request) {
        // redirect to People.create route
        return redirect()->action([ PersonController::class, 'create' ], $request->query());
    }

    public function edit(Request $request, Resource $resource) {
        // redirect to People.edit route
        return redirect()->action([ PersonController::class, 'edit' ], [ 'resource' => $resource ] + $request->query());
    }

    public function destroy(Request $request, Resource $resource) {
        // redirect to People.destroy route
        return redirect()->action([ PersonController::class, 'destroy' ], [ 'resource' => $resource ] + $request->query());
    }

}
