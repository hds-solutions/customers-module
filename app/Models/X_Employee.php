<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Contracts\AsPerson;
use HDSSolutions\Finpar\Traits\BelongsToCompany;
use HDSSolutions\Finpar\Traits\ExtendsPerson;

abstract class X_Employee extends Base\Model implements AsPerson {
    use ExtendsPerson;

    public $incrementing = false;

    protected $fillable = [
        'salary',
    ];

    protected static array $rules = [
        'salary'    => [ 'required', 'numeric', 'min:0' ],
    ];

}
