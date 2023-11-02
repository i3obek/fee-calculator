<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Contracts\FeeCalculatorInterface;
use PragmaGoTech\Interview\Enum\Term;
use PragmaGoTech\Interview\Model\LoanInquiry;
use PragmaGoTech\Interview\Repository\FeeRepository;
use PragmaGoTech\Interview\VO\AmountMatch;

class FeeCalculatorService implements FeeCalculatorInterface
{
    private int $round = 5;

    public function __construct(
        protected FeeRepository $feeRepository,
        protected AmountService $amountService,
    ) {}

    public function calculate(LoanInquiry $loan): float
    {
        $amount = $this->amountService->amount($loan);

        if (! empty($amount->exact)) {
            return $this->roundUp($this->exactFee($loan, $amount));
        }

        return $this->roundUp($this->interpolatedFee($loan, $amount));
    }

    private function exactFee(LoanInquiry $loan, AmountMatch $amountMatch): float
    {
        $fees = $this->feeRepository->find(Term::from($loan->term())->toId());

        return $fees[key($amountMatch->exact)];
    }

    /**
     * linear interpolation
     * d = (x - x0) / (x1 - x0)  // factor value in the range of [0; 1]
     * y = y0 * (1 - d) + y1 * d // interpolated value.
     */
    private function interpolatedFee(LoanInquiry $loan, AmountMatch $amountMatch): float
    {
        $term = Term::from($loan->term());
        $fees = $this->feeRepository->find($term->toId());

        // interpolation math
        $factor = ($loan->amount() - reset($amountMatch->less)) / (reset($amountMatch->less) - reset($amountMatch->more));
        return ($fees[key($amountMatch->less)] * (1 - $factor)) + ($fees[key($amountMatch->more)] * $factor);
    }

    private function roundUp(float $number): int
    {
        return ceil($number / $this->round) * $this->round;
    }
}
