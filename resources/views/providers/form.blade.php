@include('backend::components.errors')

<x-backend-form-text :resource="$resource ?? null" name="firstname" required
    label="{{ __('customers::provider.firstname.0') }}"
    placeholder="{{ __('customers::provider.firstname._') }}"
    {{-- helper="{{ __('customers::provider.firstname.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="lastname"
    label="{{ __('customers::provider.lastname.0') }}"
    placeholder="{{ __('customers::provider.lastname._') }}"
    {{-- helper="{{ __('customers::provider.lastname.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="documentno"
    label="{{ __('customers::provider.documentno.0') }}"
    placeholder="{{ __('customers::provider.documentno._') }}"
    {{-- helper="{{ __('customers::provider.documentno.?') }}" --}} />

<x-backend-form-select :resource="$resource ?? null" name="gender"
    :values="\HDSSolutions\Finpar\Models\Person::GENDERS"
    label="{{ __('customers::provider.gender.0') }}"
    placeholder="{{ __('customers::provider.gender._') }}"
    {{-- helper="{{ __('customers::provider.gender.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="ftid" required
    label="{{ __('customers::provider.ftid.0') }}"
    placeholder="{{ __('customers::provider.ftid._') }}"
    {{-- helper="{{ __('customers::provider.ftid.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="business_name"
    label="{{ __('customers::provider.business_name.0') }}"
    placeholder="{{ __('customers::provider.business_name._') }}"
    {{-- helper="{{ __('customers::provider.business_name.?') }}" --}} />

<x-backend-form-email :resource="$resource ?? null" name="email" required
    label="{{ __('customers::provider.email.0') }}"
    placeholder="{{ __('customers::provider.email._') }}"
    {{-- helper="{{ __('customers::provider.email.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="phone" required
    label="{{ __('customers::provider.phone.0') }}"
    placeholder="{{ __('customers::provider.phone._') }}"
    {{-- helper="{{ __('customers::provider.phone.?') }}" --}} />

<x-backend-form-controls
    submit="customers::providers.save"
    cancel="customers::providers.cancel" cancel-route="backend.providers" />
