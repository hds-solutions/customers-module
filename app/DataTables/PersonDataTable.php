<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\Person as Resource;
use Yajra\DataTables\Html\Column;

class PersonDataTable extends Base\DataTable {

    protected array $with = [
        'customer',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.people'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('customers::people.id.0') )
                ->hidden(),

            Column::make('customer.ftid')
                ->title( __('customers::customer.ftid.0') ),

            Column::make('customer.business_name')
                ->title( __('customers::customer.business_name.0') ),

            Column::make('lastname')
                ->title( __('customers::person.lastname.0') ),

            Column::make('firstname')
                ->title( __('customers::person.firstname.0') ),

            Column::make('actions'),
        ];
    }

}
