<?php

namespace PragmaGoTech\Interview\Controller;

use PragmaGoTech\Interview\Contracts\FeeCalculatorInterface;
use PragmaGoTech\Interview\Model\Loan;
use PragmaGoTech\Interview\Model\LoanAvailability;

class FeeCalculatorController
{
    public function __construct(
        protected FeeCalculatorInterface $feeCalc,
    ) {}

    public function index(): false|string
    {
        $loanAvailability = new LoanAvailability(new Loan(24, 2222));

        return json_encode(['success']);
    }
}
