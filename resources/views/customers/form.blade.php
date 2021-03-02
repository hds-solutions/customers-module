@include('backend::components.errors')

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.firstname.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="firstname" type="text" required
            value="{{ isset($resource) && !old('firstname') ? $resource->firstname : old('firstname') }}"
            class="form-control {{ $errors->has('firstname') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.firstname._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.firstname.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.firstname.?')</label> --}}
</div>

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.lastname.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="lastname" type="text"
            value="{{ isset($resource) && !old('lastname') ? $resource->lastname : old('lastname') }}"
            class="form-control {{ $errors->has('lastname') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.lastname._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.lastname.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.lastname.?')</label> --}}
</div>

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.ftid.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="ftid" type="text" required
            value="{{ isset($resource) && !old('ftid') ? $resource->ftid : old('ftid') }}"
            class="form-control {{ $errors->has('ftid') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.ftid._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.ftid.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.ftid.?')</label> --}}
</div>

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.business_name.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="business_name" type="text"
            value="{{ isset($resource) && !old('business_name') ? $resource->business_name : old('business_name') }}"
            class="form-control {{ $errors->has('business_name') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.business_name._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.business_name.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.business_name.?')</label> --}}
</div>

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.email.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="email" type="email"
            value="{{ isset($resource) && !old('email') ? $resource->email : old('email') }}"
            class="form-control {{ $errors->has('email') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.email._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.email.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.email.?')</label> --}}
</div>

<div class="form-row form-group align-items-center">
    <label class="col-12 col-md-3 control-label mb-0">@lang('customers::customer.phone.0')</label>
    <div class="col-11 col-md-8 col-lg-6 col-xl-4">
        <input name="phone" type="text"
            value="{{ isset($resource) && !old('phone') ? $resource->phone : old('phone') }}"
            class="form-control {{ $errors->has('phone') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.phone._')">
    </div>
    {{-- <div class="col-1">
        <i class="fas fa-info-circle ml-2 cursor-help" data-toggle="tooltip" data-placement="right"
            title="@lang('customers::customer.phone.?')"></i>
    </div> --}}
    {{-- <label class="col-12 control-label small">@lang('customers::customer.phone.?')</label> --}}
</div>

<div class="form-row form-group d-flex align-items-center">
    <label class="col-12 col-md-3 control-label m-0">@lang('customers::customer.gender.0')</label>

    <div class="col-12 col-md-9 col-xl-3">
        <select name="gender"
            value="{{ isset($resource) && !old('gender') ? $resource->genderRaw : old('gender') }}"
            class="form-control selectpicker {{ $errors->has('gender') ? 'is-danger' : '' }}"
            placeholder="@lang('customers::customer.gender._')">
            <option value="" selected disabled hidden>@lang('customers::customer.gender.0')</option>
            @foreach([
                ''          => __('customers::customer.gender.unset'),
                'male'      => __('customers::customer.gender.male'),
                'female'    => __('customers::customer.gender.female'),
            ] as $gender => $name)
            <option value="{{ $gender }}"
                @if (isset($resource) && !old('gender') && $resource->gender == $gender ||
                    old('gender') == $gender || (!isset($resource) && !old('gender') && $gender == '')) selected @endif>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="offset-0 offset-md-3 col-12 col-md-9">
        <button type="submit" class="btn btn-success">@lang('customers::customers.save')</button>
        <a href="{{ route('backend.customers') }}" class="btn btn-danger">@lang('customers::customers.cancel')</a>
    </div>
</div>
