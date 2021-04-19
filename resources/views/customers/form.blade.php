@include('backend::components.errors')

<x-backend-form-text :resource="$resource ?? null" name="firstname" required
    label="{{ __('customers::customer.firstname.0') }}"
    placeholder="{{ __('customers::customer.firstname._') }}"
    {{-- helper="{{ __('customers::customer.firstname.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="lastname"
    label="{{ __('customers::customer.lastname.0') }}"
    placeholder="{{ __('customers::customer.lastname._') }}"
    {{-- helper="{{ __('customers::customer.lastname.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="ftid" required
    label="{{ __('customers::customer.ftid.0') }}"
    placeholder="{{ __('customers::customer.ftid._') }}"
    {{-- helper="{{ __('customers::customer.ftid.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="business_name"
    label="{{ __('customers::customer.business_name.0') }}"
    placeholder="{{ __('customers::customer.business_name._') }}"
    {{-- helper="{{ __('customers::customer.business_name.?') }}" --}} />

<x-backend-form-email :resource="$resource ?? null" name="email"
    label="{{ __('customers::customer.email.0') }}"
    placeholder="{{ __('customers::customer.email._') }}"
    {{-- helper="{{ __('customers::customer.email.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="phone"
    label="{{ __('customers::customer.phone.0') }}"
    placeholder="{{ __('customers::customer.phone._') }}"
    {{-- helper="{{ __('customers::customer.phone.?') }}" --}} />

<x-backend-form-select :resource="$resource ?? null" name="gender"
    :values="\HDSSolutions\Finpar\Models\Customer::GENDERS"
    label="{{ __('customers::customer.gender.0') }}"
    placeholder="{{ __('customers::customer.gender._') }}"
    {{-- helper="{{ __('customers::customer.gender.?') }}" --}} />

<x-backend-form-controls
    submit="customers::customers.save"
    cancel="customers::customers.cancel" cancel-route="backend.customers" />
