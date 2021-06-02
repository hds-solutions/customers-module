<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\Customer as Resource;
use Yajra\DataTables\Html\Column;

class CustomerDataTable extends Base\DataTable {

    protected array $with = [
        'identity',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.customers'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('customers::customer.id.0') )
                ->hidden(),

            Column::make('ftid')
                ->title( __('customers::customer.ftid.0') ),

            Column::make('business_name')
                ->title( __('customers::customer.business_name.0') ),

            Column::make('credit_limit')
                ->title( __('customers::customer.credit_limit.0') ),

            Column::make('credit_used')
                ->title( __('customers::customer.credit_used.0') ),

            Column::make('actions'),
        ];
    }

}
