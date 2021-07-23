<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\ProviderDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Provider as Resource;

class ProviderController extends Controller {

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
        return $dataTable->render('customers::providers.index', [ 'count' => Resource::count() ]);
    }

    public function create(Request $request) {
        // redirect to People.create route
        return redirect()->route('backend.people.create');
    }

    public function edit(Request $request, Resource $resource) {
        // redirect to People.edit route
        return redirect()->route('backend.people.edit', $resource);
    }

    public function destroy(Request $request, Resource $resource) {
        // redirect to People.destroy route
        return redirect()->route('backend.people.destroy', $resource);
    }

}
