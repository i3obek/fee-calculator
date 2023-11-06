<?php

namespace Interview\Validator\Fee;

use Interview\Contracts\ConditionInterface;
use Interview\Model\LoanInquiry;
use Interview\Repository\TermRepository;

class TermCheck implements ConditionInterface
{
    public function __construct(
        protected TermRepository $termRepository,
    ) {}

    public function check(LoanInquiry $loan): bool
    {
        if (empty($this->termRepository->findByValue($loan->term()))) {
            return false;
        }

        return true;
    }
}
