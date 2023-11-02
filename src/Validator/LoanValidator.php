<?php

namespace PragmaGoTech\Interview\Validator;

use PragmaGoTech\Interview\Model\LoanInquiry;
use PragmaGoTech\Interview\Service\AmountService;
use PragmaGoTech\Interview\Service\TermService;

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