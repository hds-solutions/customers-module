@extends('backend::layouts.master')

@section('page-name', __('customers::people.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <i class="fas fa-category-plus"></i>
                @lang('customers::people.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.people.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('customers::people.create')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.people.update', $resource) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('customers::people.form')
        </form>
    </div>
</div>

@endsection
