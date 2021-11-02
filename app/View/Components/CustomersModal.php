<?php

namespace HDSSolutions\Laravel\View\Components;

use HDSSolutions\Laravel\DataTables\Modals\CustomersDataTable as DataTable;
use Illuminate\View\Component;

class CustomersModal extends Component {

    public function __construct(
        public DataTable $dataTable,
    ) {}

    public function render() {
        return fn($data) => $this->dataTable->render('customers::components.customers.modal', $data)->render();
    }
}
