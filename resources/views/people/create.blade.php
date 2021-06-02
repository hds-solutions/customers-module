@extends('backend::layouts.master')

@section('page-name', __('customers::people.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-category-plus"></i>
                @lang('customers::people.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.people.create') }}"
                    class="btn btn-sm btn-primary">@lang('customers::people.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.people.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('customers::people.form')
        </form>
    </div>
</div>

@endsection
