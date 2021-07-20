<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Contracts\AsPerson;
use HDSSolutions\Laravel\Traits\BelongsToCompany;
use HDSSolutions\Laravel\Traits\ExtendsPerson;

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
