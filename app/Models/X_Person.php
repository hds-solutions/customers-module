<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\BelongsToCompany;

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

    protected $appends = [
        'full_name',
    ];

    protected static array $rules = [
        'firstname'     => [ 'required' ],
        'lastname'      => [ 'sometimes', 'nullable' ],
        'documentno'    => [ 'required' ],
        'email'         => [ 'sometimes', 'nullable', 'email' ],
        'phone'         => [ 'sometimes', 'nullable' ],
        'gender'        => [ 'sometimes', 'nullable', 'in:male,female' ],
    ];

    public final function getFullNameAttribute():string {
        return ($this->lastname !== null ? $this->lastname.', ' : '').$this->firstname;
    }

}
