<?php

namespace PragmaGoTech\Interview\Controller;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorService;

class FeeCalculatorController
{
    public function __construct(protected FeeCalculatorService $feeCalc) {}

    public function index(): false|string
    {
        $loan = new LoanProposal(24, 2750);

        return json_encode($this->feeCalc->calculate($loan));
    }
}