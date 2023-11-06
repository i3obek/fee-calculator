<?php

namespace Interview\Service;

use Interview\Model\LoanInquiry;
use Interview\Validator\Fee\AmountCheck;
use Interview\Validator\Fee\TermCheck;
use Interview\Validator\LoanValidator;

class LoanAvailabilityService
{
    public function __construct(
        protected LoanValidator $loanValidator,
        protected AmountCheck $amountCheck,
        protected TermCheck $termCheck,
    ) {
        $this->checkAvailability();
    }

    public function isAvailable(LoanInquiry $loanInquiry): bool
    {
        return $this->loanValidator->processAvailability($loanInquiry);
    }

    private function checkAvailability(): void
    {
        $this->loanValidator->attach($this->amountCheck);
        $this->loanValidator->attach($this->termCheck);
    }
}
