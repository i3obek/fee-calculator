<?php

declare(strict_types=1);

namespace Interview\Contracts;

use Interview\Model\LoanInquiry;

interface FeeCalculatorInterface
{
    /**
     * @return float the calculated total fee
     */
    public function calculate(LoanInquiry $loan): float;
}
