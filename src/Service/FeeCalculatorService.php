<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Exception\OutOfRangeException;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Repository\TermRepository;

class FeeCalculatorService implements FeeCalculator
{
    private int $round = 5;
    private array $loanFees;

    public function __construct(protected TermRepository $repository) {}

    public function calculate(LoanProposal $loanProposal): float
    {
        $this->loanFees = $this->repository->findByTerm($loanProposal->term());

        $this->checkLoanAvailability($loanProposal->amount());

        if ($this->isLoanSpecified($loanProposal->amount())) {
            return $this->finalFee($loanProposal->amount(), $this->loanFees[$loanProposal->amount()]);
        }

        return $this->finalFee($loanProposal->amount(), $this->baseFee($loanProposal));
    }

    private function checkLoanAvailability(float $amount): void
    {
        $min = array_key_first($this->loanFees);
        $max = array_key_last($this->loanFees);

        if ($amount < $min || $amount > $max) {
            throw new OutOfRangeException();
        }
    }

    private function isLoanSpecified(float $amount): bool
    {
        return array_key_exists($amount, $this->loanFees);
    }

    private function finalFee(float $loan, float $fee): int
    {
        $amount = $loan + $fee;

        if (0 == ($amount % $this->round)) {
            return $fee;
        }

        return $this->roundUp($amount) - $loan;
    }

    private function roundUp(float $number): int
    {
        return ceil($number / $this->round) * $this->round;
    }

    private function baseFee(LoanProposal $loanProposal): float
    {
        [$closestLower, $closestHigher] = $this->getClosest($loanProposal->amount(), $this->loanFees);

        $factor = ($loanProposal->amount() - $closestLower) / ($closestHigher - $closestLower);
        return ($this->loanFees[$closestLower] * (1 - $factor)) + ($this->loanFees[$closestHigher] * $factor);
    }

    private function getClosest(int $search, array $numbers): array
    {
        $current  = null;
        $previous = null;
        foreach ($numbers as $key => $item) {
            if (null === $current || abs($search - $current) > abs($key - $search)) {
                $previous = $current;
                $current  = $key;
            }
        }

        $closest = [$current, $previous];
        sort($closest);

        return $closest;
    }
}
