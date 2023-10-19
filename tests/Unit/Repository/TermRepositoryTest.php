<?php

namespace Unit\Repository;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\RangeNotFoundException;
use PragmaGoTech\Interview\Repository\TermRepository;

class TermRepositoryTest extends TestCase
{
    public function test_repository_range_exception()
    {
        $this->expectException(RangeNotFoundException::class);
        (new TermRepository())->findByTerm(5);
    }

    public function test_repository_range_and_sorting()
    {
        $repo  = new TermRepository();
        $array = $repo->findByTerm(12);

        $this->assertIsArray($array);

        $previous = -1;
        foreach ($array as $key => $value) {
            $this->assertGreaterThan($previous, $key);
            $previous = $key;
        }
    }
}
