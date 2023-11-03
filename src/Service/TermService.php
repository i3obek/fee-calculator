<?php

namespace Interview\Service;

use Interview\Model\LoanInquiry;
use Interview\Repository\TermRepository;

class TermService
{
    public function __construct(
        protected TermRepository $termRepository,
        protected LoanAvailabilityService $loanAvailabilityService
    ) {}

    public function processAvailability(LoanInquiry $loan): bool
    {
        if (empty($this->termRepository->findByValue($loan->term()))) {
            $this->loanAvailabilityService->denyLoan();
            return false;
        }

        return true;
    }

    public function term(LoanInquiry $loan)
    {
        return $this->termRepository->findByValue($loan->term());
    }
}
