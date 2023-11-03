<?php

namespace Interview\Validator;

use Interview\Model\LoanInquiry;
use Interview\Service\AmountService;
use Interview\Service\TermService;

class LoanValidator
{
    public function __construct(
        protected TermService $termService,
        protected AmountService $amountService
    ) {}

    public function processAvailability(LoanInquiry $loan)
    {
        $this->termService->processAvailability($loan);
        $this->amountService->processAvailability($loan);
    }
}