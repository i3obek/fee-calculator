<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Contracts;

use PragmaGoTech\Interview\Model\Loan;

interface FeeCalculatorInterface
{
    /**
     * @return float the calculated total fee
     */
    public function calculate(Loan $loan): float;
}
