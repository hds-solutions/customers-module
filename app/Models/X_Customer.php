<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;
use HDSSolutions\Finpar\Traits\ExtendsPerson;

abstract class X_Customer extends Base\Model {
    use ExtendsPerson;

    public $incrementing = false;

    protected $with = [ 'identity' ];

    protected array $orderBy = [
        'business_name' => 'ASC',
    ];

    protected $fillable = [
        'ftid',
        'business_name',
        'credit',
    ];

    protected static array $rules = [
        'ftid'          => [ 'required' ],
        'business_name' => [ 'required' ],
        'credit'        => [ 'sometimes', 'nullable', 'min:0' ],
    ];

}
