<?php

namespace HDSSolutions\Finpar\Models;

use App\Models\Base\Model;
use HDSSolutions\Finpar\Traits\BelongsToCompany;

abstract class X_Customer extends Model {
    use BelongsToCompany;

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

    protected static array $createRules = [
        'firstname'     => [ 'required' ],
        'lastname'      => [ 'sometimes', 'nullable' ],
        'ftid'          => [ 'required' ],
        'business_name' => [ 'sometimes', 'nullable' ],
        'email'         => [ 'sometimes', 'nullable', 'email' ],
        'phone'         => [ 'sometimes', 'nullable' ],
        'gender'        => [ 'sometimes', 'nullable', 'in:male,female' ],
    ];

    protected static array $updateRules = [
        'firstname'     => [ 'required' ],
        'lastname'      => [ 'sometimes', 'nullable' ],
        'ftid'          => [ 'required' ],
        'business_name' => [ 'sometimes', 'nullable' ],
        'email'         => [ 'required', 'email' ],
        'phone'         => [ 'sometimes', 'nullable' ],
        'gender'        => [ 'sometimes', 'nullable', 'in:male,female' ],
    ];

}
