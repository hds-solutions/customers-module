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
        'credit_limit',
    ];

    protected static array $rules = [
        'ftid'          => [ 'required' ],
        'business_name' => [ 'required' ],
        'credit_limit'  => [ 'sometimes', 'nullable', 'min:0' ],
    ];

    public function getHasCreditEnabledAttribute():bool {
        // null: no credit enabled, 0: unlimited credit enabled, > 0: credit enabled
        return $this->credit_limit !== null;
    }

}
