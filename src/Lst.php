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

    public static function length(array $lst): int
    {
        return count($lst);
    }

    public static function hd(array $lst): mixed
    {
        assert(static::length($lst) > 0);
        return $lst[0];
    }

    public static function tl(array $lst): array
    {
        if (static::length($lst) === 0) {
            return [];
        }
        return array_slice($lst, 1);
    }

    public static function rev(array $lst): array
    {
        return array_reverse($lst);
    }

    public static function init(callable $fn, int $length): array
    {
        $lst = [];

        for ($i = 0; $i < $length; $i++) {
            $lst[] = $fn($i);
        }

        return $lst;
    }

    public static function append(array $lst1, array $lst2): array
    {
        return [...array_values($lst1), ...array_values($lst2)];
    }

    public static function flatten(array $lst): array
    {
        $newLst = [];

        foreach ($lst as $elem) {
            if (is_array($elem)) {
                $newLst = static::append($newLst, static::flatten($elem));
                continue;
            }

            $newLst[] = $elem;
        }

        return $newLst;
    }
}
