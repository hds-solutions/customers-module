<?php

namespace HDSSolutions\Laravel\DataTables;

use HDSSolutions\Laravel\Models\Customer as Resource;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class CustomerDataTable extends Base\DataTable {

    protected array $orderBy = [
        'business_name' => 'asc',
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
                ->title( __('customers::customer.credit_limit.0') )
                ->renderRaw('view:customer')
                ->data( view('customers::customers.datatable.credit_limit')->render() ),

            Column::make('credit_used')
                ->title( __('customers::customer.credit_used.0') )
                ->renderRaw('view:customer')
                ->data( view('customers::customers.datatable.credit_used')->render() )
                ->orderable(false)
                ->searchable(false),

            Column::computed('actions'),
        ];
    }

}
