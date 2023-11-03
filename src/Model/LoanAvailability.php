<?php

declare(strict_types=1);

namespace Interview\Model;

class LoanAvailability
{
    public function __construct(
        private LoanInquiry $loan,
        private bool $available = true
    ) {}

    public function loan(): LoanInquiry
    {
        return $this->loan;
    }

    public function denyLoan(): void
    {
        $this->available = false;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }
}
