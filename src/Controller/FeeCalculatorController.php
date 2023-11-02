<?php

namespace PragmaGoTech\Interview\Controller;

use PragmaGoTech\Interview\Contracts\FeeCalculatorInterface;
use PragmaGoTech\Interview\Model\LoanInquiry;
use PragmaGoTech\Interview\Model\LoanAvailability;
use PragmaGoTech\Interview\Service\LoanAvailabilityService;

class FeeCalculatorController
{
    public function __construct(
        protected LoanAvailabilityService $loanAvailabilityService,
        protected FeeCalculatorInterface $feeCalculator
    ) {}

    public function index(): false|string
    {
        $loanAvailability = new LoanAvailability(new LoanInquiry(24, 2222));

        if (! $this->loanAvailabilityService->isAvailable()) {
            return false;
        }

        return json_encode($this->feeCalculator->calculate($loanAvailability->loan()));
    }
}
