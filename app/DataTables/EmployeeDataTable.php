<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Employee as Resource;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class EmployeeDataTable extends Base\DataTable {

    protected array $orderBy = [
        'lastname'      => 'asc',
        'firstname'     => 'asc',
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

            Column::computed('actions'),
        ];
    }

    protected function joins(Builder $query):Builder {
        // add custom JOIN to people
        return $query->join('people', 'people.id', 'employees.id');
    }

    protected function searchDocumentno(Builder $query, string $value):Builder {
        // return custom search for Employee.documentno
        return $query->where('people.documentno', 'like', "%$value%");
    }

    protected function searchFirstname(Builder $query, string $value):Builder {
        // return custom search for Employee.firstname
        return $query->where('people.firstname', 'like', "%$value%");
    }

    protected function searchLastname(Builder $query, string $value):Builder {
        // return custom search for Employee.lastname
        return $query->where('people.lastname', 'like', "%$value%");
    }

}
