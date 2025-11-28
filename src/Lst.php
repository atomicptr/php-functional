<?php

namespace Atomicptr\Functional;

/**
 * A collection of functions for operating on "lists" (PHP arrays)
 *
 * Note: Map like arrays are generally unsupported but might work, this class is for lists
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
     * @template U
     * @template K
     * @param callable(T $elem, K $index): U $fn
     * @param array<K, T> $list
     * @return array<K, U>
     */
    public static function map(callable $fn, array $list): array
    {
        return array_values(array_map($fn, $list, array_keys($list)));
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
     */
    public static function filter(callable $fn, array $list): array
    {
        return array_values(array_filter($list, $fn, ARRAY_FILTER_USE_BOTH));
    }

    /**
     * Partitions the input list into two arrays based on the given predicate function.
     *
     * @template T
     * @template K
     *
     * @param callable(T $value, K $key): bool $fn The predicate function used to test each element
     * @param array<K, T> $list The input list to be partitioned
     *
     * @return array{0: T[], 1: T[]} A tuple containing two arrays:
     *         - The first array contains elements for which the predicate returned true
     *         - The second array contains elements for which the predicate returned false
     *
     * @throws \AssertionError If the predicate function returns a non-boolean value
     */
    public static function partition(callable $fn, array $list): array
    {
        $matches = [];
        $nonMatches = [];

        foreach ($list as $key => $value) {
            $res = $fn($value, $key);
            assert(is_bool($res));

            if ($res) {
                $matches[] = $value;
            } else {
                $nonMatches[] = $value;
            }
        }

        return [array_values($matches), array_values($nonMatches)];
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
     * Iterates over $list until one element applied to $fn returns true and
     * returns the index of that element.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn
     * @param array<K, T> $list
     * @return Option<K>
     */
    public static function findIndex(callable $fn, array $list): Option
    {
        foreach ($list as $key => $value) {
            $res = $fn($value, $key);
            assert(is_bool($res));

            if ($res) {
                return Option::some($key);
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
        return array_reduce($list, fn(mixed $acc, mixed $curr) => $fn($curr, $acc), $initial);
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
     * Is the list empty?
     *
     * @template T
     * @param T[] $lst
     * @return bool
     */
    public static function isEmpty(array $lst): bool
    {
        return empty($lst);
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
        return array_values(array_slice($lst, 1));
    }

    /**
     * Attempts to retrieve the element at the specified index in the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @param int $index The index to retrieve
     * @return Option<T> An Option containing the element if it exists, or None if the index is out of bounds
     */
    public static function tryNth(array $lst, int $index): Option
    {
        $lst = array_values($lst);

        if (array_key_exists($index, $lst)) {
            return Option::some($lst[$index]);
        }

        return Option::none();
    }

    /**
     * Retrieves the element at the specified index in the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @param int $index The index to retrieve
     * @return T The element at the specified index
     * @throws \AssertionError If the index is out of bounds
     */
    public static function nth(array $lst, int $index): mixed
    {
        $val = static::tryNth($lst, $index);
        assert($val->isSome());
        return $val->get();
    }

    /**
     * Retrieves the first element of the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @return T The first element of the list
     * @throws \AssertionError If the list is empty
     */
    public static function first(array $lst): mixed
    {
        return static::nth($lst, 0);
    }

    /**
     * Retrieves the second element of the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @return T The second element of the list
     * @throws \AssertionError If the list has fewer than two elements
     */
    public static function second(array $lst): mixed
    {
        return static::nth($lst, 1);
    }

    /**
     * Retrieves the third element of the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @return T The third element of the list
     * @throws \AssertionError If the list has fewer than three elements
     */
    public static function third(array $lst): mixed
    {
        return static::nth($lst, 2);
    }

    /**
     * Retrieves the last element of the list.
     *
     * @template T
     * @param array<T> $lst The input list
     * @return T The last element of the list
     * @throws \AssertionError If the list is empty
     */
    public static function last(array $lst): mixed
    {
        assert(static::length($lst) > 0);
        return static::nth($lst, static::length($lst) - 1);
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
        return array_values(array_reverse($lst));
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
     * Add element to new list
     *
     * @template T
     * @template U
     * @param T[] $lst
     * @param U $value
     * @return (T|U)[]
     */
    public static function cons(array $lst, mixed $value): array
    {
        return static::append($lst, [$value]);
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

    /**
     * Applies the function $fn to every element of $list and builds a new
     * flattened list with the results returned by $fn.
     *
     * @see Lst::map
     * @see Lst::flatten
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): T $fn
     * @param array<K, T> $list
     * @return array<K, T>
     */
    public static function flatMap(callable $fn, array $lst): array
    {
        return static::flatten(static::map($fn, $lst));
    }

    /**
     * Returns a new list containing the first $num elements of the input list.
     *
     * @template T
     * @param T[] $lst The input list
     * @param int $num The number of elements to take
     * @return T[] A new list with up to $num elements
     */
    public static function take(array $lst, int $num): array
    {
        $lst = array_values($lst);
        return array_slice($lst, 0, $num);
    }

    /**
     * Returns a new list containing elements from the start of the input list
     * until the predicate function $fn returns false.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn The predicate function
     * @param array<K, T> $lst The input list
     * @return T[] A new list with elements up to where $fn first returns false
     */
    public static function takeWhile(callable $fn, array $lst): array
    {
        $index = static::findIndex(fn(mixed $value, mixed $index) => !$fn($value, $index), $lst);

        if ($index->isNone()) {
            return $lst;
        }

        $index = $index->get();

        if ($index >= count($lst)) {
            return $lst;
        }

        return array_values(array_slice($lst, 0, $index));
    }

    /**
     * Returns a new list with the first $num elements removed.
     *
     * @template T
     * @param T[] $lst The input list
     * @param int $num The number of elements to drop
     * @return T[] A new list with $num elements removed from the start
     */
    public static function drop(array $lst, int $num): array
    {
        $lst = array_values($lst);
        return array_slice($lst, $num);
    }

    /**
     * Returns a new list with elements dropped from the start until the
     * predicate function $fn returns false.
     *
     * @template T
     * @template K
     * @param callable(T $elem, K $index): bool $fn The predicate function
     * @param array<K, T> $lst The input list
     * @return T[] A new list with elements dropped until $fn first returns false
     */
    public static function dropWhile(callable $fn, array $lst): array
    {
        $index = static::findIndex(fn(mixed $value, mixed $index) => !$fn($value, $index), $lst);

        if ($index->isNone()) {
            return [];
        }

        $index = $index->get();

        if ($index >= count($lst)) {
            return [];
        }

        return array_values(array_slice($lst, $index));
    }

    /**
     * Returns a portion of the list starting at $start with an optional length.
     *
     * @template T
     * @param T[] $lst The input list
     * @param int $start The starting index (default 0)
     * @param ?int $length The number of elements to include (default null for all remaining)
     * @return T[] A new list containing the specified slice
     */
    public static function slice(array $lst, int $start = 0, ?int $length = null): array
    {
        $lst = array_values($lst);
        return array_slice($lst, $start, $length);
    }

    /**
     * Sort a list in increasing order according to a comparison function. The comparison function must
     * return 0 if it's arguments compare as equal, a positive integer if the first is greater and a
     * negative integer if the first is smaller (see spaceship operator: <=>)
     *
     * @template T
     * @param callable(T $elem1, T $elem2): T $fn
     * @param T[] $lst
     * @return T[]
     */
    public static function sort(callable $fn, array $lst): array
    {
        usort($lst, $fn);
        return array_values($lst);
    }

    /**
     * Removes duplicate values from a list.
     *
     * @template T
     * @param T[] $lst
     * @return T[]
     */
    public static function unique(array $lst): array
    {
        return array_values(array_unique($lst));
    }

    /**
     * Sort a list in increasing order according to a comparison function and remove duplicates.
     * The comparison function must return 0 if its arguments compare as equal, a positive integer
     * if the first is greater, and a negative integer if the first is smaller (see spaceship operator: <=>).
     * Duplicate elements are identified by the comparison function returning 0 and are removed,
     * keeping only the first occurrence.
     *
     * @template T
     * @param callable(T $elem1, T $elem2): int $fn Comparison function that determines order and equality
     * @param T[] $lst Input array to be sorted and deduplicated
     * @return T[] Sorted array with unique elements
     */
    public static function sortUnique(callable $fn, array $lst): array
    {
        if (Lst::isEmpty($lst)) {
            return [];
        }

        $lst = Lst::sort($fn, $lst);

        return Lst::foldl(function (array $acc, mixed $current) use ($fn) {
            if (empty($acc)) {
                return [$current];
            }

            $prev = Lst::last($acc);

            if ($fn($prev, $current) !== 0) {
                return [...$acc, $current];
            }

            return $acc;
        }, $lst, []);
    }

    /**
     * Groups elements of an array by the result of a callable function.
     *
     * @template TKey of array-key
     * @template TValue
     *
     * @param callable(TValue): TKey $fn A function that takes an element and returns a key for grouping.
     * @param TValue[] $lst The list of elements to be grouped.
     * @return Map<TKey, TValue[]> A Map where keys are the results from $fn and values are arrays of elements that match each key.
     */
    public static function groupBy(callable $fn, array $lst): Map
    {
        return Lst::foldl(function (Map $map, mixed $elem) use ($fn) {
            $key = $fn($elem);
            return $map->update($key, fn(Option $value) => $value->isSome() ? [...$value->get(), $elem] : [$elem]);
        }, $lst, Map::empty());
    }
}
