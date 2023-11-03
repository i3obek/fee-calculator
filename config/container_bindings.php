<?php

use Interview\Contracts\FeeCalculatorInterface;
use Interview\Service\FeeCalculatorService;

return [
    FeeCalculatorInterface::class => DI\autowire(FeeCalculatorService::class),
];
