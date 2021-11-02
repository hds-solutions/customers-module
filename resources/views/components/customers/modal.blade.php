<div class="modal fade" id="customers-modal" tabindex="-1" role="dialog" aria-labelledby="customers-modal-title" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content vh-75">

            <div class="modal-header bg-light p-0 border-0">
                <div class="container-fluid px-3">

                    <div class="row py-2 border-bottom">
                        <div class="col d-flex align-items-center">
                            <i class="fas fa-search mr-2"></i>
                            @lang('customers::customers.title')
                        </div>
                        <div class="col d-flex align-items-center justify-content-end">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('backend.customers') }}" autocomplete="off"
                        data-filters-for="#{{ $dataTable->getTableAttribute('id') }}"
                        data-modal="#customers-modal" class="row py-2">
                        <input type="text" name="autocomplete" autocomplete="false" class="d-none">

                        <div class="col">

                            <x-backend-form-text name="filters[ftid]"
                                row-class="mb-1"
                                label="customers::customer.ftid.0"
                                placeholder="customers::customer.ftid._" />

                            <x-backend-form-text name="filters[business_name]"
                                row-class="mb-0"
                                label="customers::customer.business_name.0"
                                placeholder="customers::customer.business_name._" />

                            <button type="submit" class="d-none"></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-body p-0">
                {{ $dataTable->table() }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Seleccionar</button>
            </div>

        </div>
    </div>
</div>

@push('config-scripts')
{{ $dataTable->scripts() }}
@endpush
