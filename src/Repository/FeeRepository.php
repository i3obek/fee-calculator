<?php

namespace Interview\Repository;

use Interview\Contracts\ArrayRepositoryInterface;

class FeeRepository implements ArrayRepositoryInterface
{
    private static array $fees = [
        12 => [
//            0  => 50,
//            1  => 90,
//            2  => 90,
            3  => 115,
            4  => 100,
            5  => 120,
            6  => 140,
            7  => 160,
            8  => 180,
            9  => 200,
            10 => 220,
            11 => 240,
            12 => 260,
            13 => 280,
            14 => 300,
            15 => 320,
            16 => 340,
            17 => 360,
            18 => 380,
            19 => 400,
        ],
        24 => [
            0  => 70,
            1  => 100,
            2  => 120,
            3  => 160,
            4  => 200,
            5  => 240,
            6  => 280,
            7  => 320,
            8  => 360,
            9  => 400,
            10 => 440,
            11 => 480,
            12 => 520,
            13 => 560,
            14 => 600,
            15 => 640,
            16 => 680,
            17 => 720,
            18 => 760,
            19 => 800,
        ],
    ];

    public static function find($id): array
    {
        if (! array_key_exists($id, self::$fees)) {
            return [];
        }

        return self::$fees[$id];
    }

    public static function findByValue($value): array
    {
        $fees = [];
        foreach (self::$fees as $termId => $item) {
            $amount = array_search($value, self::$fees);
            if ($amount) {
                $fees[$termId] = [$amount => $value];
            }
        }

        return $fees;
    }

    public static function findAll(): array
    {
        return self::$fees;
    }

    public static function add(mixed $value): void
    {
        self::$fees[] = $value;
    }
}
