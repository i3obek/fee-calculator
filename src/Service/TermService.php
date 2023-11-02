<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\LoanInquiry;
use PragmaGoTech\Interview\Repository\TermRepository;

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
