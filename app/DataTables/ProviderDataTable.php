<?php

namespace HDSSolutions\Finpar\DataTables;

use HDSSolutions\Finpar\Models\Provider as Resource;
use Yajra\DataTables\Html\Column;

class ProviderDataTable extends Base\DataTable {

    protected array $with = [
        'identity',
    ];

    public function __construct() {
        parent::__construct(
            Resource::class,
            route('backend.providers'),
        );
    }

    protected function getColumns() {
        return [
            Column::computed('id')
                ->title( __('customers::provider.id.0') )
                ->hidden(),

            Column::make('ftid')
                ->title( __('customers::provider.ftid.0') ),

            Column::make('business_name')
                ->title( __('customers::provider.business_name.0') ),

            Column::make('actions'),
        ];
    }

}
