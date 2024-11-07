<?php

namespace Atomicptr\Functional;

use ArrayAccess;
use ArrayIterator;
use Atomicptr\Functional\Exceptions\ImmutableException;
use IteratorAggregate;
use OutOfRangeException;
use Traversable;

/**
 * An immutable key-value map implementation with functional programming operations.
 *
 * The Map class provides a safe, immutable way to store and manipulate key-value pairs
 * with type-safe operations. All modification operations return a new instance of the map.
 *
 * @template TKey
 * @template TValue
 */
final class Map implements Traversable, IteratorAggregate, ArrayAccess
{
    private function __construct(
        private \stdClass $data = new \stdClass()
    ) {
    }

    /**
     * Sets a new key-value pair in the map, returning a new Map instance.
     *
     * @param TKey $key The key to set
     * @param TValue $value The value to associate with the key
     * @return static A new Map instance with the added key-value pair
     */
    public function set(mixed $key, mixed $value): static
    {
        $new = clone $this->data;
        $new->{$key} = $value;
        return static::from((array) $new);
    }

    /**
     * Checks if a key exists in the map.
     *
     * @param TKey $key The key to check
     * @return bool True if the key exists, false otherwise
     */
    public function exists(mixed $key): bool
    {
        return isset($this->data->{$key});
    }

    /**
     * Retrieves a value by key, wrapped in an Option.
     *
     * @param TKey $key The key to look up
     * @return Option<TValue> Some(value) if the key exists, None otherwise
     */
    public function get(mixed $key): Option
    {
        if (! $this->exists($key)) {
            return Option::none();
        }
        return Option::some($this->data->{$key});
    }

    /**
     * Removes a key-value pair from the map, returning a new Map instance.
     *
     * @param TKey $key The key to remove
     * @return static A new Map instance without the specified key
     */
    public function remove(mixed $key): static
    {
        if (! $this->exists($key)) {
            return $this;
        }
        return static::fromList(Lst::filter(fn (array $pair) => Lst::first($pair) !== $key, $this->toList()));
    }

    /**
     * Updates a value in the map using a function.
     *
     * @param TKey $key The key to update
     * @param callable(Option<TValue>): Option<TValue> $fn The function
     * @return static A new Map instance with the updated value
     */
    public function update(mixed $key, callable $fn): static
    {
        $result = $fn($this->get($key));
        if (!($result instanceof Option)) {
            $result = Option::some($result);
        }
        if ($result->isNone()) {
            return $this->remove($key);
        }
        return $this->set($key, $result->value());
    }

    /**
     * Finds the first value that matches the predicate function.
     *
     * @param callable(TKey, TValue): bool $fn The predicate function
     * @return Option<TValue> Some(value) if found, None otherwise
     */
    public function find(callable $fn): Option
    {
        $result = Lst::find(fn (array $pair) => $fn(Lst::first($pair), Lst::second($pair)), $this->toList());
        if ($result->isNone()) {
            return Option::none();
        }
        return Option::some(Lst::second($result->value()));
    }

    /**
     * Creates a union of two maps, with values from the other map taking precedence.
     *
     * @param Map<TKey, TValue> $other The map to union with
     * @return static A new Map instance containing all key-value pairs from both maps
     */
    public function union(Map $other): static
    {
        return static::from([...$this->toArray(), ...$other->toArray()]);
    }

    /**
     * Creates an intersection of two maps, keeping only keys that exist in both maps.
     *
     * @param Map<TKey, TValue> $other The map to intersect with
     * @return static A new Map instance containing only shared key-value pairs
     */
    public function intersect(Map $other): static
    {
        return $this->union($other)->filter(fn (mixed $key) => $this->exists($key));
    }

    /**
     * Filters the map using a predicate function.
     *
     * @param callable(TKey, TValue): bool $fn The predicate function
     * @return static A new Map instance containing only pairs that match the predicate
     */
    public function filter(callable $fn): static
    {
        return static::fromList(Lst::filter(fn (array $pair) => $fn(Lst::first($pair), Lst::second($pair)), $this->toList()));
    }

    /**
     * Maps over the values in the map using a function.
     *
     * @template TNewValue
     * @param callable(TKey, TValue): TNewValue $fn The function
     * @return Map<TKey, TNewValue> A new Map instance with transformed values
     */
    public function map(callable $fn): static
    {
        return static::fromList(Lst::map(fn (array $pair) => [Lst::first($pair), $fn(Lst::first($pair), Lst::second($pair))], $this->toList()));
    }

    /**
     * Returns an array of all keys in the map.
     *
     * @return array<TKey> Array of keys
     */
    public function keys(): array
    {
        return array_keys(get_object_vars($this->data));
    }

    /**
     * Returns an array of all values in the map.
     *
     * @return array<TValue> Array of values
     */
    public function values(): array
    {
        return array_keys(get_object_vars($this->data));
    }

    /**
     * Returns the number of key-value pairs in the map.
     *
     * @return int The number of pairs
     */
    public function length(): int
    {
        return count($this->keys());
    }

    /**
     * Executes a function for each key-value pair in the map.
     *
     * @param callable(TKey, TValue): void $fn The function to execute
     */
    public function forAll(callable $fn): void
    {
        Lst::forAll($fn, $this->toList());
    }

    /**
     * Converts the map to a PHP array.
     *
     * @return array<TKey, TValue> The map as an associative array
     */
    public function toArray(): array
    {
        return (array)$this->data;
    }

    /**
     * Converts the map to a list of key-value pairs.
     *
     * @return array<array{TKey, TValue}> List of [key, value] pairs
     */
    public function toList(): array
    {
        return Lst::map(fn (mixed $key) => [$key, $this->data->{$key}], $this->keys());
    }

    /**
     * Converts the map to a Collection instance.
     *
     * @return Collection<array{TKey, TValue}> Collection of [key, value] pairs
     */
    public function collection(): Collection
    {
        return Collection::from($this->toList());
    }

    /**
     * Creates a new Map instance from an associative array.
     *
     * @template TNewKey
     * @template TNewValue
     * @param array<TNewKey, TNewValue> $data The source array
     * @return Map<TNewKey, TNewValue> A new Map instance
     */
    public static function from(array $data): static
    {
        return new static((object)$data);
    }

    /**
     * Creates a new Map instance from a list of key-value pairs.
     *
     * @template TNewKey
     * @template TNewValue
     * @param array<array{TNewKey, TNewValue}> $pairs List of [key, value] pairs
     * @return Map<TNewKey, TNewValue> A new Map instance
     * @throws \AssertionError if any pair doesn't contain exactly two elements
     */
    public static function fromList(array $pairs): static
    {
        $map = [];
        foreach ($pairs as $pair) {
            assert(count($pair) === 2, "every pair must contain of two elements");
            list($key, $value) = $pair;
            $map[$key] = $value;
        }
        return static::from($map);
    }

    /**
     * Creates a new Map instance from a Collection of key-value pairs.
     *
     * @template TNewKey
     * @template TNewValue
     * @param Collection<array{TNewKey, TNewValue}> $collection Collection of [key, value] pairs
     * @return Map<TNewKey, TNewValue> A new Map instance
     */
    public static function fromCollection(Collection $collection): static
    {
        return static::fromList($collection->toArray());
    }

    /**
     * Creates a new empty Map instance.
     *
     * @template TNewKey
     * @template TNewValue
     * @return Map<TNewKey, TNewValue> A new empty Map instance
     */
    public static function empty(): static
    {
        return static::from([]);
    }

    /**
     * Create an iterator to iterate over maps
     * @return Traversable<T>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Check if the Map has an element for the given key
     *
     * @see Map::exists
     * @param TValue $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->exists($offset);
    }

    /**
     * Get the element for the given key, throws when it doesn't exist
     *
     * @param TKey $offset
     * @return TValue
     */
    public function offsetGet(mixed $offset): mixed
    {
        $value = $this->get($offset);
        if ($value->isNone()) {
            throw new OutOfRangeException("Map: Invalid index requested: $offset");
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
