<?php

namespace Interview\Service;

use Interview\Model\LoanAvailability;
use Interview\Validator\LoanValidator;

class LoanAvailabilityService
{
    public function __construct(
        protected LoanAvailability $loanAvailability,
        protected LoanValidator $loanValidator,
    ) {}

    public function denyLoan(): void
    {
        $this->loanAvailability->denyLoan();
    }

    public function isAvailable(): bool
    {
        $this->loanValidator->processAvailability($this->loanAvailability->loan());
        return $this->loanAvailability->isAvailable();
    }
}
