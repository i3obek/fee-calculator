<?php

namespace Interview\Controller;

use Interview\Contracts\FeeCalculatorInterface;
use Interview\Model\LoanInquiry;
use Interview\Model\LoanAvailability;
use Interview\Service\LoanAvailabilityService;

class FeeCalculatorController
{
    public function __construct(
        protected LoanAvailabilityService $loanAvailabilityService,
        protected FeeCalculatorInterface $feeCalculator
    ) {}

    public function index(): false|string
    {
        $loanAvailability = new LoanAvailability(new LoanInquiry(12, 2222));

        if (! $this->loanAvailabilityService->isAvailable($loanAvailability)) {
            return json_encode(false);
        }

        return json_encode($this->feeCalculator->calculate($loanAvailability->loan()));
    }
}
