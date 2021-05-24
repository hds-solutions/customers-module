<?php

namespace HDSSolutions\Finpar\Models;

class Customer extends X_Customer {

    public function invoices() {
        return $this->morphMany(Invoice::class, 'partnerable');
    }

    public function cashLines() {
        return $this->hasManyThrough(CashLine::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
    }

    public function cards() {
        return $this->hasManyThrough(Card::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
    }

    public function credits() {
        return $this->hasManyThrough(Credit::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
    }

    public function creditNotes() {
        return $this->hasManyThrough(CreditNote::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
    }

    public function checks() {
        return $this->hasManyThrough(Check::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
    }

    public function promissoryNotes() {
        return $this->hasManyThrough(PromissoryNote::class, Payment::class, 'partnerable_id', 'id')
            ->where('partnerable_type', self::class);
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
        // TODO: add pending checks
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
