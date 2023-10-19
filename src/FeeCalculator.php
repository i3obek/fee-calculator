<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculator
{
    /**
     * @return float the calculated total fee
     */
    public function calculate(LoanProposal $loanProposal): float;
}
