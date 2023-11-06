<?php

namespace Interview\Service;

use Interview\Model\LoanInquiry;
use Interview\Repository\AmountRepository;
use Interview\VO\AmountMatch;

class AmountService
{
    public function __construct(
        protected AmountRepository $amountRepository,
    ) {}

    public function amount(LoanInquiry $loan): AmountMatch
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
