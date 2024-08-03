<?php

namespace Atomicptr\Functional;

final class Lst
{
    public static function map(callable $fn, array $list): array
    {
        return array_map($fn, $list);
    }

    public static function filter(callable $fn, array $list): array
    {
        return array_filter($list, $fn, ARRAY_FILTER_USE_BOTH);
    }

    public static function find(callable $fn, array $list): Option
    {
        foreach ($list as $key => $value) {
            $res = $fn($value, $key);
            assert(is_bool($res));

            if ($res) {
                return Option::some($value);
            }
        }

        return Option::none();
    }

    public static function forAll(callable $fn, array $list): void
    {
        foreach ($list as $key => $value) {
            $fn($value, $key);
        }
    }

    public static function foldl(callable $fn, array $list, mixed $initial = null): mixed
    {
        return array_reduce($list, $fn, $initial);
    }

    public static function foldr(callable $fn, array $list, mixed $initial = null): mixed
    {
        return array_reduce($list, fn (mixed $acc, mixed $curr) => $fn($curr, $acc), $initial);
    }

    public static function some(callable $fn, array $list): bool
    {
        foreach ($list as $key => $value) {
            $res = $fn($value, $key);
            assert(is_bool($res));

            if ($res) {
                return true;
            }
        }

        return false;
    }

    public static function every(callable $fn, array $list): bool
    {
        foreach ($list as $key => $value) {
            $res = $fn($value, $key);
            assert(is_bool($res));

            if (!$res) {
                return false;
            }
        }

        return true;
    }
}
