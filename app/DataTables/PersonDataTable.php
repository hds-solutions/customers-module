<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Person as Resource;
use Yajra\DataTables\Html\Column;

class PersonDataTable extends Base\DataTable {

    // protected array $with = [
    //     'customer',
    // ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.people'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('customers::person.id.0') )
                ->hidden(),

            Column::make('documentno')
                ->title( __('customers::person.documentno.0') ),

            Column::make('lastname')
                ->title( __('customers::person.lastname.0') ),

            Column::make('firstname')
                ->title( __('customers::person.firstname.0') ),

            Column::make('email')
                ->title( __('customers::person.email.0') ),

            Column::make('phone')
                ->title( __('customers::person.phone.0') ),

            Column::make('actions'),
        ];
    }

}
