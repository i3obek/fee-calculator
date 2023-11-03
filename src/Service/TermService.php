<?php

namespace Interview\Service;

use Interview\Model\LoanInquiry;
use Interview\Repository\TermRepository;

class TermService
{
    public function __construct(
        protected TermRepository $termRepository,
    ) {}

    public function isAvailable(LoanInquiry $loan): bool
    {
        if (empty($this->termRepository->findByValue($loan->term()))) {
            return false;
        }

        return true;
    }

    public function term(LoanInquiry $loan)
    {
        return $this->termRepository->findByValue($loan->term());
    }
}
