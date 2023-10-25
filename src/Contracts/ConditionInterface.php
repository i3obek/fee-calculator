<?php

namespace PragmaGoTech\Interview\Contracts;

use PragmaGoTech\Interview\Model\Loan;

interface ConditionInterface
{
    public function processAvailability(Loan $loan);
}