@include('backend::components.errors')

<div class="row">
    <div class="col-3 col-xl-2 pr-0">
        <ul class="nav nav-tabs tabs-left h-100 border-right">
            <li class="nav-item">
                <a class="nav-link active" href="#person" data-toggle="tab">@lang('customers::people.title')</a>
            </li>
            <li class="nav-item pl-3">
                <a class="nav-link" href="#customer" data-toggle="tab">@lang('customers::customer.active.0')</a>
            </li>
            <li class="nav-item pl-3">
                <a class="nav-link" href="#provider" data-toggle="tab">@lang('customers::provider.active.0')</a>
            </li>
            <li class="nav-item pl-3">
                <a class="nav-link" href="#employee" data-toggle="tab">@lang('customers::employee.active.0')</a>
            </li>
        </ul>
    </div>

    <div class="col-9 col-xl-10 py-3 border-top border-bottom">
        <div class="tab-content">
            <div class="tab-pane active" id="person">

                <x-backend-form-text :resource="$resource ?? null" name="firstname" required
                    label="{{ __('customers::person.firstname.0') }}"
                    placeholder="{{ __('customers::person.firstname._') }}"
                    {{-- helper="{{ __('customers::person.firstname.?') }}" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="lastname"
                    label="{{ __('customers::person.lastname.0') }}"
                    placeholder="{{ __('customers::person.lastname._') }}"
                    {{-- helper="{{ __('customers::person.lastname.?') }}" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="documentno" required
                    label="{{ __('customers::person.documentno.0') }}"
                    placeholder="{{ __('customers::person.documentno._') }}"
                    {{-- helper="{{ __('customers::person.documentno.?') }}" --}} />

                <x-backend-form-email :resource="$resource ?? null" name="email"
                    label="{{ __('customers::person.email.0') }}"
                    placeholder="{{ __('customers::person.email._') }}"
                    {{-- helper="{{ __('customers::person.email.?') }}" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="phone"
                    label="{{ __('customers::person.phone.0') }}"
                    placeholder="{{ __('customers::person.phone._') }}"
                    {{-- helper="{{ __('customers::person.phone.?') }}" --}} />

                <x-backend-form-select :resource="$resource ?? null" name="gender"
                    :values="\HDSSolutions\Laravel\Models\Person::GENDERS"
                    label="{{ __('customers::person.gender.0') }}"
                    placeholder="{{ __('customers::person.gender._') }}"
                    {{-- helper="{{ __('customers::person.gender.?') }}" --}} />

            </div>
            <div class="tab-pane" id="customer">

                <x-backend-form-boolean name="customer[active]" value="{{ isset($resource) && $resource->customer !== null }}"
                    label="{{ __('customers::customer.active.0') }}"
                    placeholder="{{ __('customers::customer.active._') }}"
                    helper="{{ __('customers::customer.active.?') }}" />

                <x-backend-form-text :resource="$resource->customer ?? null" name="customer[ftid]"
                    field="ftid"
                    label="{{ __('customers::customer.ftid.0') }}"
                    placeholder="{{ __('customers::customer.ftid._') }}"
                    {{-- helper="{{ __('customers::customer.ftid.?') }}" --}} />

                <x-backend-form-text :resource="$resource->customer ?? null" name="customer[business_name]"
                    field="business_name"
                    label="{{ __('customers::customer.business_name.0') }}"
                    placeholder="{{ __('customers::customer.business_name._') }}"
                    {{-- helper="{{ __('customers::customer.business_name.?') }}" --}} />

                <x-backend-form-amount :resource="$resource->customer ?? null" name="customer[credit_limit]"
                    field="credit_limit"
                    label="{{ __('customers::customer.credit_limit.0') }}"
                    placeholder="{{ __('customers::customer.credit_limit._') }}"
                    {{-- helper="{{ __('customers::customer.credit_limit.?') }}" --}} />

                <x-backend-form-number :resource="$resource->customer ?? null" name="customer[grace_days]"
                    field="grace_days"
                    label="{{ __('customers::customer.grace_days.0') }}"
                    placeholder="{{ __('customers::customer.grace_days._') }}"
                    {{-- helper="{{ __('customers::customer.grace_days.?') }}" --}} />

            </div>
            <div class="tab-pane" id="provider">

                <x-backend-form-boolean name="provider[active]" value="{{ isset($resource) && $resource->provider !== null }}"
                    label="{{ __('customers::provider.active.0') }}"
                    placeholder="{{ __('customers::provider.active._') }}"
                    helper="{{ __('customers::provider.active.?') }}" />

                <x-backend-form-text :resource="$resource->provider ?? null" name="provider[ftid]"
                    field="ftid"
                    label="{{ __('customers::provider.ftid.0') }}"
                    placeholder="{{ __('customers::provider.ftid._') }}"
                    {{-- helper="{{ __('customers::provider.ftid.?') }}" --}} />

                <x-backend-form-text :resource="$resource->provider ?? null" name="provider[business_name]"
                    field="business_name"
                    label="{{ __('customers::provider.business_name.0') }}"
                    placeholder="{{ __('customers::provider.business_name._') }}"
                    {{-- helper="{{ __('customers::provider.business_name.?') }}" --}} />

            </div>
            <div class="tab-pane" id="employee">

                <x-backend-form-boolean name="employee[active]" value="{{ isset($resource) && $resource->employee !== null }}"
                    label="{{ __('customers::employee.active.0') }}"
                    placeholder="{{ __('customers::employee.active._') }}"
                    helper="{{ __('customers::employee.active.?') }}" />

                <x-backend-form-amount :resource="$resource->employee ?? null" name="employee[salary]"
                    field="salary"
                    label="{{ __('customers::employee.salary.0') }}"
                    placeholder="{{ __('customers::employee.salary._') }}"
                    {{-- helper="{{ __('customers::employee.salary.?') }}" --}} />

            </div>
        </div>
    </div>
</div>


<x-backend-form-controls
    submit="customers::people.save"
    cancel="customers::people.cancel" cancel-route="backend.people"
    class="pt-3" />
