<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;
use HDSSolutions\Finpar\Traits\ExtendsPerson;

abstract class X_Customer extends Base\Model {
    use ExtendsPerson;

    public $incrementing = false;

    protected array $orderBy = [
        'business_name' => 'ASC',
    ];

    protected $fillable = [
        'ftid',
        'business_name',
        'has_credit',
        'credit',
    ];

    protected static array $rules = [
        'ftid'          => [ 'required' ],
        'business_name' => [ 'required' ],
        'has_credit'    => [ 'required', 'boolean' ],
        'credit'        => [ 'sometimes', 'nullable', 'min:0' ],
    ];

}
