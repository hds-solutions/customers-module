<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Contracts\AsPerson;
use HDSSolutions\Laravel\Traits\BelongsToCompany;
use HDSSolutions\Laravel\Traits\ExtendsPerson;

abstract class X_Customer extends Base\Model implements AsPerson {
    use ExtendsPerson;

    public $incrementing = false;

    protected array $orderBy = [
        'business_name' => 'ASC',
    ];

    protected $fillable = [
        'ftid',
        'business_name',
        'credit_limit',
        'credit_used',
        'grace_days',
    ];

    protected $with = [ 'identity' ];

    protected $appends = [ 'credit_used' ];

    protected static array $rules = [
        'ftid'          => [ 'required' ],
        'business_name' => [ 'required' ],
        'credit_limit'  => [ 'sometimes', 'nullable', 'min:0' ],
        'credit_used'   => [ 'sometimes', 'nullable', 'min:0' ],
        'grace_days'    => [ 'sometimes', 'nullable', 'numeric', 'min:0' ],
    ];

    public function getHasCreditEnabledAttribute():bool {
        // null: no credit enabled, 0: unlimited credit enabled, > 0: credit enabled
        return $this->credit_limit !== null;
    }

    public function hasCreditEnabled():bool {
        return $this->hasCreditEnabled;
    }

    public function getCreditUsedAttribute():int {
        return 0;
    }

    public function getCreditAvailableAttribute():int {
        // TODO: use credit_limit - credit_used value

        // if has unlimited credit, return maximun integer
        return $this->has_unlimited_credit ? PHP_INT_MAX :
            // return credit limit - sum(unpaid invoices amount) of this partnerable
            $this->credit_limit - Invoice::ofPartnerable($this)->paid(false)->get()
                // only pending amount (total - paid_amount)
                ->sum(fn($invoice) => $invoice->total - $invoice->paid_amount);
    }

    public function getHasUnlimitedCreditAttribute():bool {
        return $this->credit_limit === 0;
    }

    public function hasUnlimitedCredit():bool {
        return $this->hasUnlimitedCredit;
    }

}
