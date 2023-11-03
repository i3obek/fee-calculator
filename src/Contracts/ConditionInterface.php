<?php

namespace Interview\Contracts;

use Interview\Model\LoanInquiry;

interface ConditionInterface
{
    public function processAvailability(LoanInquiry $loan);
}