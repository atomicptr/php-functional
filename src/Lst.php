<?php

namespace Atomicptr\Functional;

/**
 * A collection of functions for operating on "lists" (PHP arrays)
 */
final class Lst
{
    /**
     * Applies the function $fn to every element of $list and builds a new
     * list with the results returned by $fn.
     *
     * Same as array_map
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): T $fn
     * @param array<K, T> $list
     * @return array<K, T>
     *
     */
    public static function map(callable $fn, array $list): array
    {
        return array_map($fn, $list);
    }

    /**
     * Applies the function $fn to every element of $list and builds a new
     * list with the elements of $list where $fn returned true
     *
     * Same as array_filter
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn
     * @param array<K, T> $list
     * @return array<K, T>
     *
     */
    public static function filter(callable $fn, array $list): array
    {
        return array_filter($list, $fn, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Iterates over $list until one element applied to $fn returns true and
     * return that element.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn
     * @param array<K, T> $list
     * @return Option<T>
     *
     */
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

    /**
     * Applies the function $fn to every element of $list.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): void $fn
     * @param array<K, T> $list
     * @return void
     */
    public static function forAll(callable $fn, array $list): void
    {
        foreach ($list as $key => $value) {
            $fn($value, $key);
        }
    }

    /**
     * Reduces the array to a single value by applying $fn from left to right.
     *
     * @template T
     * @template K
     * @template R
     * @param callable(R $acc, T $curr, K $index): R $fn
     * @param array<K, T> $list
     * @param R $initial
     * @return R
     */
    public static function foldl(callable $fn, array $list, mixed $initial = null): mixed
    {
        return array_reduce($list, $fn, $initial);
    }

    /**
     * Reduces the array to a single value by applying $fn from right to left.
     *
     * @template T
     * @template K
     * @template R
     * @param callable(T $curr, R $acc): R $fn
     * @param array<K, T> $list
     * @param R $initial
     * @return R
     */
    public static function foldr(callable $fn, array $list, mixed $initial = null): mixed
    {
        return array_reduce($list, fn (mixed $acc, mixed $curr) => $fn($curr, $acc), $initial);
    }

    /**
     * Returns true if at least one element in the list satisfies the predicate $fn.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn
     * @param array<K, T> $list
     * @return bool
     */
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


    /**
     * Returns true if all elements in the list satisfy the predicate $fn.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn
     * @param array<K, T> $list
     * @return bool
     */
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

    /**
     * Returns the number of elements in the list.
     *
     * @template T
     * @param T[] $lst
     * @return int
     */
    public static function length(array $lst): int
    {
        return count($lst);
    }

    /**
     * Returns the first element of the list.
     *
     * @template T
     * @param T[] $lst
     * @return T
     */
    public static function hd(array $lst): mixed
    {
        assert(static::length($lst) > 0);
        return $lst[0];
    }

    /**
     * Returns a new list containing all elements except the first.
     *
     * @template T
     * @param T[] $lst
     * @return T[]
     */
    public static function tl(array $lst): array
    {
        if (static::length($lst) === 0) {
            return [];
        }
        return array_slice($lst, 1);
    }

    /**
     * Returns a new list with elements in reverse order.
     *
     * @template T
     * @param T[] $lst
     * @return T[]
     */
    public static function rev(array $lst): array
    {
        return array_reverse($lst);
    }

    /**
     * Creates a new list of given length using the provided function.
     *
     * @template T
     * @param callable(int $index): T $fn
     * @param int $length
     * @return T[]
     */
    public static function init(callable $fn, int $length): array
    {
        $lst = [];

        for ($i = 0; $i < $length; $i++) {
            $lst[] = $fn($i);
        }

        return $lst;
    }

    /**
     * Concatenates two lists.
     *
     * @template T
     * @template U
     * @param T[] $lst1
     * @param U[] $lst2
     * @return (T|U)[]
     */
    public static function append(array $lst1, array $lst2): array
    {
        return [...array_values($lst1), ...array_values($lst2)];
    }

    /**
     * Flattens a nested array structure.
     *
     * @template T
     * @param (T|T[])[] $lst
     * @return T[]
     */
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
