<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

class LoanAvailability
{

    public function __construct(
        private Loan $loan,
        private bool $available = true
    ) {}

    public function prevent(): void
    {
        $this->available = false;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }
}
