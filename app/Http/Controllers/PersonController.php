<?php

namespace HDSSolutions\Laravel\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Laravel\DataTables\PersonDataTable as DataTable;
use HDSSolutions\Laravel\Http\Request;
use HDSSolutions\Laravel\Models\Person as Resource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller {

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
        return $dataTable->render('customers::people.index', [ 'count' => Resource::count() ]);
    }

    public function create(Request $request) {
        // show create form
        return view('customers::people.create');
    }

    public function store(Request $request) {
        // start a transaction
        DB::beginTransaction();

        // create resource
        $resource = new Resource( $request->input() );

        // save resource
        if (!$resource->save())
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        foreach ([ 'customer', 'provider', 'employee' ] as $type)
            // create/update resource Type if flag is enabled
            if (filter_var($request->$type['active'], FILTER_VALIDATE_BOOLEAN) ||
                // FIXME: why this gets null when value="true"?
                $request->$type['active'] === null) {

                // get ResourceType on current Person
                $resource_type = $resource->$type()->make( $request->input( $type ) );

                // save resource
                if (!$resource_type->save())
                    // redirect with errors
                    return back()->withInput()
                        ->withErrors( $resource_type->errors() );
            }

        // confirm transaction
        DB::commit();

        // check return type
        return $request->has('only-form') ?
            // redirect to popup callback
            view('backend::components.popup-callback', compact('resource')) :
            // redirect to resources list
            redirect()->route('backend.people');
    }

    public function show(Request $request, Resource $resource) {
        // redirect to list
        return redirect()->route('backend.people');
    }

    public function edit(Request $request, Resource $resource) {
        // show edit form
        return view('customers::people.edit', compact('resource'));
    }

    public function update(Request $request, Resource $resource) {
        // start a transaction
        DB::beginTransaction();

        // save resource
        if (!$resource->update( $request->input() ))
            // redirect with errors
            return back()->withInput()
                ->withErrors( $resource->errors() );

        foreach ([ 'customer', 'provider', 'employee' ] as $type) {
            // create/update resource Type if flag is enabled
            if (filter_var($request->$type['active'], FILTER_VALIDATE_BOOLEAN) ||
                // FIXME: why this gets null when value="true"?
                $request->$type['active'] === null) {

                // get ResourceType on current Person
                $resource_type = $resource->$type()->withTrashed()->firstOrNew();
                // update values
                $resource_type->fill( $request->input( $type ) );

                // save resource
                if (!$resource_type->save())
                    // redirect with errors
                    return back()->withInput()
                        ->withErrors( $resource_type->errors() );

                // untrash if was trashed
                if ($resource_type->trashed()) $resource_type->restore();

            // delete resource Type if flag is disabled
            } elseif ($resource_type = $resource->$type) {
                // delete resource type
                if (!$resource_type->delete(with_identity: false))
                    // return back with errors
                    return back()->withInput()
                        ->withErrors( $resource_type->errors() );
            }
        }

        // confirm transaction
        DB::commit();

        // redirect to list
        return redirect()->route('backend.people');
    }

    public function destroy(Request $request, Resource $resource) {
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() );

        // redirect to list
        return redirect()->route('backend.people');
    }

}
