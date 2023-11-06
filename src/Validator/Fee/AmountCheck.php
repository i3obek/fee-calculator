<?php

namespace Interview\Validator\Fee;

use Interview\Contracts\ConditionInterface;
use Interview\Model\LoanInquiry;
use Interview\Repository\AmountRepository;

class AmountCheck implements ConditionInterface
{
    public function __construct(
        protected AmountRepository $amountRepository,
    ) {}

    public function check(LoanInquiry $loan): bool
    {
        $available = $this->amountRepository->findAll();
        $reversed  = array_reverse($available);

        $max = array_pop($available);
        $min = array_pop($reversed);

        if ($loan->amount() < $min || $loan->amount() > $max) {
            return false;
        }

        return true;
    }
}
