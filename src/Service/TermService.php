<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\Loan;
use PragmaGoTech\Interview\Repository\TermRepository;

class TermService
{
    public function __construct(
        protected TermRepository $termRepository,
        protected LoanAvailabilityService $loanAvailabilityService
    ) {}

    public function processAvailability(Loan $loan): bool
    {
        if (empty($this->termRepository->findByValue($loan->term()))) {
            $this->loanAvailabilityService->prevent();
            return false;
        }

        return true;
    }

    public function term(Loan $loan)
    {
        return $this->termRepository->findByValue($loan->term());
    }
}
