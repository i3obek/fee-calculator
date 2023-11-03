<?php

namespace Unit\Repository;

use Interview\Repository\TermRepository;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class TermRepositoryTest extends TestCase
{
    public function test_repository_range_is_missing()
    {
        $this->assertEmpty((new TermRepository())->findByValue(5));
    }

    public function test_repository_range_and_sorting()
    {
        $repo  = new TermRepository();
        $array = $repo->findByValue(12);

        $this->assertIsArray($array);

        $previous = -1;
        foreach ($array as $key => $value) {
            $this->assertGreaterThan($previous, $key);
            $previous = $key;
        }
    }
}
