<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_Customer extends Base\Model {
    use BelongsToCompany;

    const GENDERS = [
        ''          => 'customers::customer.gender.unset',
        'male'      => 'customers::customer.gender.male',
        'female'    => 'customers::customer.gender.female',
    ];

    protected array $orderBy = [
        'name'      => 'ASC',
    ];

    protected $fillable = [
        'firstname',
        'lastname',
        'ftid',
        'business_name',
        'email',
        'phone',
        'gender',
    ];

    protected static array $rules = [
        'firstname'     => [ 'required' ],
        'lastname'      => [ 'sometimes', 'nullable' ],
        'ftid'          => [ 'required' ],
        'business_name' => [ 'sometimes', 'nullable' ],
        'email'         => [ 'sometimes', 'nullable', 'email' ],
        'phone'         => [ 'sometimes', 'nullable' ],
        'gender'        => [ 'sometimes', 'nullable', 'in:male,female' ],
    ];

}
