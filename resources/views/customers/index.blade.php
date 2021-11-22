@extends('backend::layouts.master')

@section('page-name', __('customers::customers.title'))
@section('description', __('customers::customers.description'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <i class="fas fa-table mr-2"></i>
                @lang('customers::customers.index')
            </div>
            <div class="col-6 d-flex justify-content-end">
                @can('customers.crud.create')
                <a href="{{ route('backend.customers.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('customers::customers.create')</a>
                @endcan
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($count)
            <div class="table-responsive">
                {{ $dataTable->table() }}
                @include('backend::components.datatable-actions', [
                    'resource'  => 'customers',
                    'actions'   => [ 'update', 'delete' ],
                    'label'     => '{resource.full_name}',
                ])
            </div>
        @else
            <div class="text-center m-t-30 m-b-30 p-b-10">
                <h2><i class="fas fa-table text-custom"></i></h2>
                <h3>@lang('backend.empty.title')</h3>
                <p class="text-muted">
                    @can('customers.crud.create')
                    @lang('backend.empty.description')
                    <a href="{{ route('backend.customers.create') }}" class="text-custom">
                        <ins>@lang('customers::customers.create')</ins>
                    </a>
                    @endcan
                </p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('config-scripts')
{{ $dataTable->scripts() }}
@endpush
