<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Contracts\AsPerson;
use HDSSolutions\Finpar\Traits\BelongsToCompany;
use HDSSolutions\Finpar\Traits\ExtendsPerson;

abstract class X_Provider extends Base\Model implements AsPerson {
    use ExtendsPerson;

    public $incrementing = false;

    protected array $orderBy = [
        'business_name' => 'ASC',
    ];

    protected $fillable = [
        'ftid',
        'business_name',
    ];

    protected $with = [ 'identity' ];

    protected static array $rules = [
        'ftid'          => [ 'required' ],
        'business_name' => [ 'required' ],
    ];

}
