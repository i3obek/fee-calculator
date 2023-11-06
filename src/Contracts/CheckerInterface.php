<?php

namespace Interview\Contracts;

use Interview\Model\LoanInquiry;

interface CheckerInterface
{
    public function processAvailability(LoanInquiry $loanInquiry): bool;
}
