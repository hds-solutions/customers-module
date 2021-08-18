<?php

namespace HDSSolutions\Laravel\Models;

use HDSSolutions\Laravel\Traits\HasPayments;

class Customer extends X_Customer {
    use HasPayments;

    public function invoices() {
        return $this->morphMany(Invoice::class, 'partnerable');
    }

    public function cashLines() {
        return $this->morphMany(CashLine::class, 'partnerable');
    }

    public function cards() {
        return $this->hasManyPayments(Card::class);
    }

    public function credits() {
        return $this->hasManyPayments(Credit::class);
    }

    public function creditNotes() {
        return $this->hasManyPayments(CreditNote::class);
    }

    public function checks() {
        return $this->hasManyPayments(Check::class);
    }

    public function promissoryNotes() {
        return $this->hasManyPayments(PromissoryNote::class);
    }

    public function payments() {
        return $this->payments;
    }

    public function getPaymentsAttribute() {
        return $this->cashLines
            ->merge($this->cards)
            ->merge($this->credits)
            ->merge($this->creditNotes)
            ->merge($this->checks)
            ->merge($this->promissoryNotes);
    }

    public function updateCreditUsed():bool {
        // acumulator
        $creditUsed = 0;

        // add pending invoices amount
        $this->invoices()->paid(false)
            ->each(fn($invoice) => $creditUsed += $invoice->pending_amount);
        // TODO: add pending checks paid=false
        // $this->checks;
        // add pending promissory notes amount
        $this->promissoryNotes()->paid(false)
            ->each(fn($promissoryNote) => $creditUsed += $promissoryNote->payment_amount);
        // add pending credit notes
        $this->creditNotes()->available()->paid(false)
            ->each(fn($creditNote) => $creditUsed += $creditNote->availableAmount);

        // update credit used
        return $this->update([ 'credit_used' => $creditUsed ]);
    }

}
