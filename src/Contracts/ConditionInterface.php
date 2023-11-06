<?php

namespace Interview\Contracts;

use Interview\Model\LoanInquiry;

interface ConditionInterface
{
    public function check(LoanInquiry $loan);
}
