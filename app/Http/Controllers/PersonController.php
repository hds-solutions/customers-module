<?php

namespace HDSSolutions\Finpar\Http\Controllers;

use App\Http\Controllers\Controller;
use HDSSolutions\Finpar\DataTables\PersonDataTable as DataTable;
use HDSSolutions\Finpar\Http\Request;
use HDSSolutions\Finpar\Models\Person as Resource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller {

    public function __construct() {
        // check resource Policy
        $this->authorizeResource(Resource::class, 'resource');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // show create form
        return view('customers::people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // start a transaction
        DB::beginTransaction();

        // create resource
        $resource = new Resource( $request->input() );

        // save resource
        if (!$resource->save())
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() )
                ->withInput();

        foreach ([ 'customer', 'provider', 'employee' ] as $type)
            if (filter_var($request->$type['active'], FILTER_VALIDATE_BOOLEAN) ||
                $request->$type['active'] === null) { // FIXME: why this gets null when value="true"?
                // get ResourceType on current Person
                $resource_type = $resource->$type()->make( $request->input( $type ) );

                // save resource
                if (!$resource_type->save())
                    // redirect with errors
                    return back()
                        ->withErrors( $resource_type->errors() )
                        ->withInput();
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource) {
        // redirect to list
        return redirect()->route('backend.people');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource) {
        // show edit form
        return view('customers::people.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // start a transaction
        DB::beginTransaction();

        // find resource
        $resource = Resource::findOrFail($id);

        // save resource
        if (!$resource->update( $request->input() ))
            // redirect with errors
            return back()
                ->withErrors( $resource->errors() )
                ->withInput();

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
                    return back()
                        ->withErrors( $resource_type->errors() )
                        ->withInput();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // find resource
        $resource = Resource::findOrFail($id);
        // delete resource
        if (!$resource->delete())
            // redirect with errors
            return back();
        // redirect to list
        return redirect()->route('backend.people');
    }

}
