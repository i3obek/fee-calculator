<?php

namespace Interview\Controller;

use Interview\Contracts\FeeCalculatorInterface;
use Interview\Model\LoanInquiry;
use Interview\Service\LoanAvailabilityService;
use Interview\Validator\LoanValidator;

class FeeCalculatorController
{
    public function __construct(
        protected LoanAvailabilityService $loanAvailabilityService,
        protected FeeCalculatorInterface $feeCalculator,
        protected LoanValidator $loanValidator,
    ) {}

    public function index(): false|string
    {
        $loanInquiry = new LoanInquiry(12, 2222);

        if (! $this->loanAvailabilityService->isAvailable($loanInquiry)) {
            return json_encode(false);
        }

        return json_encode($this->feeCalculator->calculate($loanInquiry));
    }
}
