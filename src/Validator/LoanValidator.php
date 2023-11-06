<?php

namespace Interview\Validator;

use Interview\Contracts\CheckerInterface;
use Interview\Contracts\ConditionInterface;
use Interview\Model\LoanInquiry;

class LoanValidator implements CheckerInterface
{
    private array $conditions;

    public function attach(ConditionInterface $condition): void
    {
        $this->conditions[] = $condition;
    }

    public function processAvailability(LoanInquiry $loanInquiry): bool
    {
        /** @var ConditionInterface $condition */
        foreach ($this->conditions as $condition) {
            if (! $condition->check($loanInquiry)) {
                return false;
            }
        }

        return true;
    }
}
