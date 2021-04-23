@extends('backend::layouts.master')

@section('page-name', __('customers::providers.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-category-plus"></i>
                @lang('customers::providers.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.providers.create') }}"
                    class="btn btn-sm btn-primary">@lang('customers::providers.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.providers.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('customers::providers.form')
        </form>
    </div>
</div>

@endsection
