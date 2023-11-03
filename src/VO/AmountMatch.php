<?php

namespace Interview\VO;

class AmountMatch
{
    public function __construct(
        public ?array $exact = null,
        public ?array $less = null,
        public ?array $more = null
    ) {}
}
