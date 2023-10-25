<?php

use PragmaGoTech\Interview\Contracts\FeeCalculatorInterface;
use PragmaGoTech\Interview\Service\FeeCalculatorService;

return [
    FeeCalculatorInterface::class => DI\autowire(FeeCalculatorService::class),
];
