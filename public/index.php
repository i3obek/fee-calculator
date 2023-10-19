<?php

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorService;

require __DIR__.'/../vendor/autoload.php';

$calculator = new FeeCalculatorService();

$loan = new LoanProposal(24, 2750);

$fee = $calculator->calculate($loan);
echo $fee;
