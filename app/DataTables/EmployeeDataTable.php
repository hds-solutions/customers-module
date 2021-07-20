<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Employee as Resource;
use Yajra\DataTables\Html\Column;

class EmployeeDataTable extends Base\DataTable {

    protected array $with = [
        'identity',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.employees'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('customers::employee.id.0') )
                ->hidden(),

            Column::make('documentno')
                ->title( __('customers::person.documentno.0') ),

            Column::make('lastname')
                ->title( __('customers::person.lastname.0') ),

            Column::make('firstname')
                ->title( __('customers::person.firstname.0') ),

            Column::make('salary')
                ->title( __('customers::employee.salary.0') )
                ->renderRaw('view:employee')
                ->data( view('customers::employees.datatable.salary')->render() ),

            Column::make('actions'),
        ];
    }

}
