<?php

namespace Interview\Repository;

use Interview\Contracts\ArrayRepositoryInterface;

class AmountRepository implements ArrayRepositoryInterface
{
    private static array $amounts = [
        0  => 1000,
        1  => 2000,
        2  => 3000,
        3  => 4000,
        4  => 5000,
        5  => 6000,
        6  => 7000,
        7  => 8000,
        8  => 9000,
        9  => 10000,
        10 => 11000,
        11 => 12000,
        12 => 13000,
        13 => 14000,
        14 => 15000,
        15 => 16000,
        16 => 17000,
        17 => 18000,
        18 => 19000,
        19 => 20000,
    ];

    public static function find($id): array
    {
        if (! array_key_exists($id, self::$amounts)) {
            return [];
        }

        return [$id => self::$amounts[$id]];
    }

    public static function findByValue($value): array
    {
        $id = array_search($value, self::$amounts);
        if (! $id) {
            return [];
        }

        return [$id => $value];
    }

    public static function findAll(): array
    {
        asort(self::$amounts);

        return self::$amounts;
    }

    public static function add(mixed $value): void
    {
        self::$amounts[] = $value;
    }
}
