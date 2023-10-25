<?php

namespace PragmaGoTech\Interview\Contracts;

interface ArrayRepositoryInterface
{
    public static function find($id);
    public static function findByValue($value);
    public static function findAll();
    public static function add(mixed $value): void;
}