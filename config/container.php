<?php

use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Service\FeeCalculatorService;

return [
    FeeCalculator::class => DI\autowire(FeeCalculatorService::class),
];
