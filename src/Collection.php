<?php

namespace Atomicptr\Functional;

use ArrayAccess;
use ArrayIterator;
use Atomicptr\Functional\Exceptions\ImmutableException;
use Iterator;
use IteratorAggregate;
use OutOfRangeException;
use Traversable;

/**
 * A wrapper around PHP arrays enabling piping several functions together
 *
 * @template T
 */
final class Collection implements Traversable, IteratorAggregate, ArrayAccess
{
    private function __construct(
        private array $data = [],
    ) {
    }

    /**
     * Create a new collection from an already existing list
     *
     * @param array<T> $array
     * @return Collection<T>
     */
    public static function from(array $array): static
    {
        return new static(array_values($array));
    }

    /**
     * Create a new collection from an iterator (This will load the entire iterator into memory)
     *
     * @param Iterator<T> $iterator
     * @return Collection<T>
     */
    public static function fromIterator(Iterator $iterator): static
    {
        $arr = [];

        while ($elem = $iterator->next()) {
            $arr[] = $elem;
        }

        return static::from($arr);
    }

    /**
     * Convert the collection to a PHP array
     *
     * @return array<T>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Check if the collection has an element at the given index
     *
     * @param mixed $index
     * @return bool
     */
    public function has(mixed $index): bool
    {
        return isset($this->data[$index]);
    }

    /**
     * Get the element at the given index, wrapped in an Option
     *
     * @param int $index
     * @return Option<T>
     */
    public function get(int $index): Option
    {
        if (!$this->has($index)) {
            return Option::none();
        }
        return Option::some($this->data[$index]);
    }

    /**
     * Apply a function to each element in the collection
     *
     * @template U
     * @param callable(T $elem, int $index): U $fn
     * @return Collection<U>
     */
    public function map(callable $fn): static
    {
        return static::from(Lst::map($fn, $this->data));
    }

    /**
     * Filter the collection based on a predicate function
     *
     * @param callable(T $elem, int $index): bool $fn
     * @return Collection<T>
     */
    public function filter(callable $fn): static
    {
        return static::from(Lst::filter($fn, $this->data));
    }

    /**
     * Partitions the input list into two arrays based on the given predicate function.
     *
     * @template K
     *
     * @param callable(T $value, K $key): bool $fn The predicate function used to test each element
     *
     * @return array{0: Collection<T>, 1: Collection<T>} A tuple containing two collections:
     *         - The first collection contains elements for which the predicate returned true
     *         - The second collection contains elements for which the predicate returned false
     *
     * @throws \AssertionError If the predicate function returns a non-boolean value
     */
    public function partition(callable $fn): array
    {
        list($matches, $nonMatches) = Lst::partition($fn, $this->data);
        return [static::from($matches), static::from($nonMatches)];
    }

    /**
     * Apply a function to each element in the collection without returning a value
     *
     * @param callable(T $elem, int $index): void $fn
     * @return void
     */
    public function forAll(callable $fn): void
    {
        Lst::forAll($fn, $this->data);
    }

    /**
     * Find the first element that satisfies a predicate function
     *
     * @param callable(T $elem, int $index): bool $fn
     * @return Option<T>
     */
    public function find(callable $fn): Option
    {
        return Lst::find($fn, $this->data);
    }

    /**
     * Reduce the collection to a single value, applying the function from left to right
     *
     * @template U
     * @param callable(U $acc, T $curr, int $index): U $fn
     * @param U $initial
     * @return U
     */
    public function foldl(callable $fn, mixed $initial = null): mixed
    {
        return Lst::foldl($fn, $this->data, $initial);
    }

    /**
     * Reduce the collection to a single value, applying the function from right to left
     *
     * @template U
     * @param callable(T $curr, U $acc): U $fn
     * @param U $initial
     * @return U
     */
    public function foldr(callable $fn, mixed $initial = null): mixed
    {
        return Lst::foldr($fn, $this->data, $initial);
    }

    /**
     * Check if any element in the collection satisfies the predicate function
     *
     * @param callable(T $elem, int $index): bool $fn
     * @return bool
     */
    public function some(callable $fn): bool
    {
        return Lst::some($fn, $this->data);
    }

    /**
     * Check if all elements in the collection satisfy the predicate function
     *
     * @param callable(T $elem, int $index): bool $fn
     * @return bool
     */
    public function every(callable $fn): bool
    {
        return Lst::every($fn, $this->data);
    }

    /**
     * Get the number of elements in the collection
     *
     * @return int
     */
    public function length(): int
    {
        return Lst::length($this->data);
    }

    /**
     * Is the list empty?
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return Lst::isEmpty($this->data);
    }

    /**
     * Get the first element of the collection
     *
     * @return T
     */
    public function hd(): mixed
    {
        return Lst::hd($this->data);
    }

    /**
     * Get a new collection with all elements except the first
     *
     * @return Collection<T>
     */
    public function tl(): static
    {
        return static::from(Lst::tl($this->data));
    }

    /**
     * Retrieves the first element of the list.
     *
     * @template T
     * @return T The first element of the list
     * @throws \AssertionError If the list is empty
     */
    public function first(): mixed
    {
        return Lst::first($this->data);
    }

    /**
     * Retrieves the second element of the list.
     *
     * @template T
     * @return T The second element of the list
     * @throws \AssertionError If the list has fewer than two elements
     */
    public function second(): mixed
    {
        return Lst::second($this->data);
    }

    /**
     * Retrieves the third element of the list.
     *
     * @template T
     * @return T The third element of the list
     * @throws \AssertionError If the list has fewer than three elements
     */
    public function third(): mixed
    {
        return Lst::third($this->data);
    }

    /**
     * Retrieves the last element of the list.
     *
     * @template T
     * @return T The last element of the list
     * @throws \AssertionError If the list is empty
     */
    public function last(): mixed
    {
        return Lst::last($this->data);
    }

    /**
     * Reverse the order of elements in the collection
     *
     * @return Collection<T>
     */
    public function rev(): static
    {
        return static::from(Lst::rev($this->data));
    }

    /**
     * Append another collection to this collection
     *
     * @param Collection<T> $collection
     * @return Collection<T>
     */
    public function append(Collection $collection): static
    {
        return static::from(Lst::append($this->data, $collection->data));
    }

    /**
     * Add element to new list
     *
     * @template U
     * @param U $value
     * @return Collection<T|U>
     */
    public function cons(mixed $value): Collection
    {
        return static::from(Lst::cons($this->data, $value));
    }

    /**
     * Flatten a nested collection structure
     *
     * @return Collection<T>
     */
    public function flatten(): static
    {
        return static::from(Lst::flatten($this->data));
    }

    /**
     * Sort a list in increasing order according to a comparison function. The comparison function must
     * return 0 if it's arguments compare as equal, a positive integer if the first is greater and a
     * negative integer if the first is smaller (see spaceship operator: <=>)
     *
     * @param callable(T $elem1, T $elem2): T $fn
     * @return Collection<T>
     */
    public function sort(callable $fn): static
    {
        return static::from(Lst::sort($fn, $this->data));
    }

    /**
     * Create an iterator to iterate over collections
     * @return Traversable<T>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Check if the collection has an element at the given index.
     *
     * @see Collection::has
     * @param mixed $index
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    /**
     * Get the element at the given index, throws when it doesn't exist
     *
     * @param int $index
     * @return T
     */
    public function offsetGet(mixed $offset): mixed
    {
        $value = $this->get($offset);
        if ($value->isNone()) {
            throw new OutOfRangeException("Collection: Invalid index requested: $offset");
        }
        return $this->get($offset)->value();
    }

    /**
     * This does nothing but throwing
     * @throws ImmutableException
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new ImmutableException();
    }

    /**
     * This does nothing but throwing
     * @throws ImmutableException
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new ImmutableException();
    }
}
