<?php

namespace Interview\Service;

use Interview\Model\LoanAvailability;

class LoanAvailabilityService
{
    public function __construct(
        protected TermService $termService,
        protected AmountService $amountService
    ) {}

    public function isAvailable(LoanAvailability $loanAvailability): bool
    {
        if ($this->termService->isAvailable($loanAvailability->loan())
            && $this->amountService->isAvailable($loanAvailability->loan())
        ) {
            return true;
        }

        $loanAvailability->denyLoan();

        return false;
    }
}
