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
                <button type="button" class="btn btn-warning"
                    data-dismiss="modal" data-target="#customers-modal">Cancelar</button>
                <button type="button" class="btn btn-secondary"
                    data-toggle="modal" data-target="#new-customer-modal">Crear Nuevo <small>[Shift+F3]</small></button>
                <button type="submit" class="btn btn-primary">Seleccionar</button>
            </div>

        </div>
    </div>

    <div class="modal fade" id="new-customer-modal" tabindex="-1" role="dialog" aria-labelledby="new-customer-modal-title" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-sm modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('backend.people.store') }}" autocomplete="off">
                    <input type="text" name="autocomplete" autocomplete="false" class="d-none">

                    <div class="modal-header bg-light p-0 border-0">
                        <div class="container-fluid px-3">

                            <div class="row py-2 border-bottom">
                                <div class="col d-flex align-items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    @lang('customers::customers.create')
                                </div>
                                <div class="col d-flex align-items-center justify-content-end">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-body">

                        <div class="form-row mb-2">
                            <div class="col">
                                <x-form-input type="text" name="customer[ftid]" required
                                    placeholder="customers::customer.ftid._" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <x-form-input type="text" name="customer[business_name]" required
                                    placeholder="customers::customer.business_name._" />
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal" data-target="#new-customer-modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@push('config-scripts')
{{ $dataTable->scripts() }}
@endpush

@push('pre-scripts')
    <script src="{{ asset(mix('customers-module/assets/js/app.js')) }}"></script>
@endpush
