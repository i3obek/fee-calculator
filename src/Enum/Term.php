<?php

namespace PragmaGoTech\Interview\Enum;

use PragmaGoTech\Interview\Repository\TermRepository;

enum Term: int
{
    case Twelve     = 12;
    case TwentyFour = 24;

    public function toId(): int
    {
        return array_search($this, TermRepository::findAll());
    }
}
