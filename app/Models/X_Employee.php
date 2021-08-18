<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Contracts\AsPerson;
use HDSSolutions\Laravel\Traits\BelongsToCompany;
use HDSSolutions\Laravel\Traits\ExtendsPerson;

abstract class X_Employee extends Base\Model implements AsPerson {
    use ExtendsPerson;

    public $incrementing = false;

    protected $fillable = [
        'salary',
        'user_id',
    ];

    protected $with = [ 'identity' ];

    protected static array $rules = [
        'salary'    => [ 'required', 'numeric', 'min:0' ],
        'user_id'   => [ 'sometimes', 'nullable' ],
    ];

}
