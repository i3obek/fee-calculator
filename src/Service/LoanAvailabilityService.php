<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\LoanAvailability;

class LoanAvailabilityService
{

    public function __construct(
        protected LoanAvailability $loanAvailability,
    ) {}

    public function prevent(): void
    {
        $this->loanAvailability->prevent();
    }
}
