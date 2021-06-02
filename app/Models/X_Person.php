<?php

namespace HDSSolutions\Finpar\Models;

use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_Person extends Base\Model {
    use BelongsToCompany;

    const GENDERS = [
        ''          => 'customers::person.gender.unset',
        'male'      => 'customers::person.gender.male',
        'female'    => 'customers::person.gender.female',
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
