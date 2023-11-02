<?php

namespace PragmaGoTech\Interview\Contracts;

use PragmaGoTech\Interview\Model\LoanInquiry;

interface ConditionInterface
{
    public function processAvailability(LoanInquiry $loan);
}