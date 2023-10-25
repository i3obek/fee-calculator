<?php

namespace PragmaGoTech\Interview\Repository;

use PragmaGoTech\Interview\Contracts\ArrayRepositoryInterface;

class TermRepository implements ArrayRepositoryInterface
{
    private static array $terms = [
        0 => 12,
        1 => 24,
    ];

    public static function find($id): array
    {
        if (! array_key_exists($id, self::$terms)) {
            return [];
        }

        return [$id => self::$terms[$id]];
    }

    public static function findByValue($value): array
    {
        $id = array_search($value, self::$terms);
        if (! $id) {
            return [];
        }

        return [$id => $value];
    }

    public static function findAll(): array
    {
        return self::$terms;
    }

    public static function add(mixed $value): void
    {
        self::$terms[] = $value;
    }
}
