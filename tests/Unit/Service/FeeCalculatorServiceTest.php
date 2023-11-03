<?php

namespace Unit\Service;

use Interview\Contracts\FeeCalculatorInterface;
use Interview\Model\LoanInquiry;
use Interview\Repository\AmountRepository;
use Interview\Repository\FeeRepository;
use Interview\Service\AmountService;
use Interview\Service\FeeCalculatorService;
use Interview\Service\LoanAvailabilityService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FeeCalculatorServiceTest extends TestCase
{
    private FeeCalculatorInterface $feeCalc;

    protected function setUp(): void
    {
        parent::setUp();

        $this->feeCalc = new FeeCalculatorService(
            new FeeRepository(),
            new AmountService(
                new AmountRepository(),
                $this->createMock(LoanAvailabilityService::class)
            )
        );
    }

    #[DataProvider('exampleLoans')]
    public function test_loan_calculation($expected, $term, $amount)
    {
        $this->assertEquals($expected, $this->feeCalc->calculate(new LoanInquiry($term, $amount)));
    }

    public static function exampleLoans(): array
    {
        return [
            [385, 12, 19250],
            [140, 12, 7000],
            [460, 24, 11500],
            [115, 24, 2750],
            [520, 24, 13000],
        ];
    }

//    #[DataProvider('unavailableLoans')]
//    public function test_range_exceptions(int $term, int $amount)
//    {
//        $this->expectException(OutOfRangeException::class);
//        $this->feeCalc->calculate(new LoanInquiry($term, $amount));
//    }

    public static function unavailableLoans(): array
    {
        return [
            [12, 999],
            [12, 20001],
            [24, 999],
            [24, 20001],
        ];
    }
}
