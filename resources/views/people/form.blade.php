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
                    label="customers::person.firstname.0"
                    placeholder="customers::person.firstname._"
                    {{-- helper="customers::person.firstname.?" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="lastname"
                    label="customers::person.lastname.0"
                    placeholder="customers::person.lastname._"
                    {{-- helper="customers::person.lastname.?" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="documentno" required
                    label="customers::person.documentno.0"
                    placeholder="customers::person.documentno._"
                    {{-- helper="customers::person.documentno.?" --}} />

                <x-backend-form-email :resource="$resource ?? null" name="email"
                    label="customers::person.email.0"
                    placeholder="customers::person.email._"
                    {{-- helper="customers::person.email.?" --}} />

                <x-backend-form-text :resource="$resource ?? null" name="phone"
                    label="customers::person.phone.0"
                    placeholder="customers::person.phone._"
                    {{-- helper="customers::person.phone.?" --}} />

                <x-backend-form-select :resource="$resource ?? null" name="gender"
                    :values="\HDSSolutions\Laravel\Models\Person::GENDERS"
                    label="customers::person.gender.0"
                    placeholder="customers::person.gender._"
                    {{-- helper="customers::person.gender.?" --}} />

            </div>
            <div class="tab-pane" id="customer">

                <x-backend-form-boolean name="customer[active]" value="{{ isset($resource) && $resource->customer !== null }}"
                    label="customers::customer.active.0"
                    placeholder="customers::customer.active._"
                    helper="customers::customer.active.?" />

                <x-backend-form-text :resource="$resource->customer ?? null" name="customer[ftid]"
                    field="ftid"
                    label="customers::customer.ftid.0"
                    placeholder="customers::customer.ftid._"
                    {{-- helper="customers::customer.ftid.?" --}} />

                <x-backend-form-text :resource="$resource->customer ?? null" name="customer[business_name]"
                    field="business_name"
                    label="customers::customer.business_name.0"
                    placeholder="customers::customer.business_name._"
                    {{-- helper="customers::customer.business_name.?" --}} />

                <x-backend-form-amount :resource="$resource->customer ?? null" name="customer[credit_limit]"
                    field="credit_limit"
                    label="customers::customer.credit_limit.0"
                    placeholder="customers::customer.credit_limit._"
                    {{-- helper="customers::customer.credit_limit.?" --}} />

                <x-backend-form-number :resource="$resource->customer ?? null" name="customer[grace_days]"
                    field="grace_days"
                    label="customers::customer.grace_days.0"
                    placeholder="customers::customer.grace_days._"
                    {{-- helper="customers::customer.grace_days.?" --}} />

            </div>
            <div class="tab-pane" id="provider">

                <x-backend-form-boolean name="provider[active]" value="{{ isset($resource) && $resource->provider !== null }}"
                    label="customers::provider.active.0"
                    placeholder="customers::provider.active._"
                    helper="customers::provider.active.?" />

                <x-backend-form-text :resource="$resource->provider ?? null" name="provider[ftid]"
                    field="ftid"
                    label="customers::provider.ftid.0"
                    placeholder="customers::provider.ftid._"
                    {{-- helper="customers::provider.ftid.?" --}} />

                <x-backend-form-text :resource="$resource->provider ?? null" name="provider[business_name]"
                    field="business_name"
                    label="customers::provider.business_name.0"
                    placeholder="customers::provider.business_name._"
                    {{-- helper="customers::provider.business_name.?" --}} />

            </div>
            <div class="tab-pane" id="employee">

                <x-backend-form-boolean name="employee[active]" value="{{ isset($resource) && $resource->employee !== null }}"
                    label="customers::employee.active.0"
                    placeholder="customers::employee.active._"
                    helper="customers::employee.active.?" />

                <x-backend-form-amount :resource="$resource->employee ?? null" name="employee[salary]"
                    field="salary"
                    label="customers::employee.salary.0"
                    placeholder="customers::employee.salary._"
                    {{-- helper="customers::employee.salary.?" --}} />

                <x-backend-form-foreign :resource="$resource->employee ?? null" name="employee[user_id]"
                    :values="$users" :default="$resource->employee->user_id ?? null"

                    {{-- foreign="currencies" foreign-add-label="cash::currencies.add" --}}
                    data-live-search="true" show="full_name"

                    label="customers::employee.user_id.0"
                    placeholder="customers::employee.user_id._"
                    {{-- helper="customers::employee.user_id.?" --}} />

            </div>
        </div>
    </div>
</div>


<x-backend-form-controls
    submit="customers::people.save"
    cancel="customers::people.cancel" cancel-route="backend.people"
    class="pt-3" />
