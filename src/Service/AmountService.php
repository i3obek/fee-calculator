<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\VO\AmountMatch;
use PragmaGoTech\Interview\Model\Loan;
use PragmaGoTech\Interview\Repository\AmountRepository;

class AmountService
{
    public function __construct(
        protected AmountRepository $amountRepository,
        protected LoanAvailabilityService $loanAvailabilityService
    ) {}

    public function processAvailability(Loan $loan): bool
    {
        $available = $this->amountRepository->findAll();
        $reversed  = array_reverse($available);

        $max = array_pop($available);
        $min = array_pop($reversed);

        if ($loan->amount() < $min || $loan->amount() > $max) {
            $this->loanAvailabilityService->prevent();
            return false;
        }

        return true;
    }

    public function amount(Loan $loan): AmountMatch
    {
        $result = $this->exact($loan->amount());

        if (empty($result)) {
            $result = $this->closest($loan->amount());

            return new AmountMatch(less: $result[0], more: $result[1]);
        }

        return new AmountMatch(exact: $result);
    }

    private function exact(float $amount): array
    {
        return $this->amountRepository->findByValue($amount);
    }

    private function closest(float $amount): array
    {
        $current  = null;
        $previous = null;
        foreach ($this->amountRepository->findAll() as $key => $value) {
            if (null === $current || abs($amount - array_values($current)[0]) > abs($value - $amount)) {
                $previous = $current;
                $current  = [$key => $value];
            }
        }

        return [$previous, $current];
    }
}
