<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\HasPayments;

class Provider extends X_Provider {
    use HasPayments;

    public function invoices() {
        return $this->morphMany(Invoice::class, 'partnerable');
    }

    public function creditNotes() {
        return $this->hasManyPayments(CreditNote::class);
    }

}
