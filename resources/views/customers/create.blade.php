@extends('backend::layouts.master')

@section('page-name', __('customers::customers.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-category-plus"></i>
                @lang('customers::customers.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.customers.create') }}"
                    class="btn btn-sm btn-primary">@lang('customers::customers.add')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.customers.store') }}" enctype="multipart/form-data">
            @csrf
            @include('customers::customers.form')
        </form>
    </div>
</div>

@endsection