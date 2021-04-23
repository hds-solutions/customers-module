<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_Person extends Base\Model {
    use BelongsToCompany;

    const GENDERS = [
        ''          => 'customers::customer.gender.unset',
        'male'      => 'customers::customer.gender.male',
        'female'    => 'customers::customer.gender.female',
    ];

    protected array $orderBy = [
        'lastname'  => 'ASC',
        'firstname' => 'ASC',
    ];

    protected $fillable = [
        'firstname',
        'lastname',
        'documentno',
        'email',
        'phone',
        'gender',
    ];

    protected static array $rules = [
        'firstname'     => [ 'required' ],
        'lastname'      => [ 'sometimes', 'nullable' ],
        'documentno'    => [ 'required' ],
        'email'         => [ 'sometimes', 'nullable', 'email' ],
        'phone'         => [ 'sometimes', 'nullable' ],
        'gender'        => [ 'sometimes', 'nullable', 'in:male,female' ],
    ];

}
